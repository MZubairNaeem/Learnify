@extends('layouts.master')
@section('title')
    Roles
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Roles
        @endslot
        @slot('title')
            List
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-0">Roles</h5>
                        <a href="{{ route('addroles') }}" type="button" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="alternative-pagination"
                        class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SR No.</th>
                                <th>Role</th>
                                <th>Description</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($roles as $key => $role)
                            <tbody>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td class="status">
                                        <span class="badge badge-soft-success text-uppercase">
                                            {{-- @if ($role->permissions->count() > 0) --}}
                                            @if ($role->name != 'Super Admin')
                                                <i class="las la-info-circle" style="font-size:14px;color:rgb(39, 207, 39)"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#permissionModel{{ $key }}"></i>
                                            @elseif($role->name == 'Super Admin')
                                                All Permission
                                            @else
                                                No Permission
                                            @endif
                                            {{-- @endif    --}}
                                        </span>
                                    </td>
                                    <td style="white-space: normal !important;">
                                        @if ($role->name != 'Super Admin')
                                            @can('Edit Role')
                                                <a href="{{ route('editroles',  encrypt($role->id)) }}"
                                                    class="btn btn-sm btn-success">Edit</a>
                                            @endcan
                                            @if ($role->name != 'Teacher' && $role->name != 'Student')
                                                @can('Delete Role')
                                                    <a data-bs-toggle="modal" data-bs-target="#deleteModal{{ $key }}"
                                                        class="btn btn-sm btn-danger">Delete</a>
                                                @endcan
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade bs-example-modal-sm" id="permissionModel{{ $key }}"
                                    role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="mySmallModalLabel">Permissions</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="px-4 py-2">
                                                @foreach ($permissions as $permission)
                                                    @if ($role->permissions->contains($permission->id))
                                                        <h6 class=" text-left">{{ $permission->name }}</h6>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                                    data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>
                                                    Close</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $key }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $key }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $key }}">Confirm
                                                    Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this role?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('deleterole', encrypt($role->id)) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('assets/libs/jsvectormap//world-merc.js') }}"></script> --}}

    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-analytics.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
@endsection
