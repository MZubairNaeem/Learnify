@extends('layouts.master')
@section('title') Roles @endsection

@section('css')
<!-- Select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Breadcrumb Trail -->
@component('components.breadcrumb')
@slot('li_1')
    Roles
@endslot
@slot('title')
    Add
@endslot
@endcomponent

<!-- Session Messages -->
@include('partials.session')

<!-- Add employee Form -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title mb-0">Add Role</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <form method="POST" 
                    {{-- action="{{ route('update-role',encrypt($role->id))}}"  --}}
                    enctype="multipart/form-data">
                        @csrf    
                        @method('POST')
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="roleInput" class="form-label">Role Name<span style="color: red"> *</span></label>
                                <div>
                                    <input type="text" value="{{ $role->name }}" required class="form-control form-control-icon has-validation" id="roleInput" name="roleInput" placeholder="Enter title">
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="descriptionInput" class="form-label">Role Description<span style="color: red"> *</span></label>
                                <div>
                                    <input type="text" value="{{ $role->description }}" class="form-control form-control-icon" id="descriptionInput" name="descriptionInput" placeholder="Enter Description">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label for="choices-multiple-remove-button" class="form-label">
                                    Select Permissions for Role<span style="color: red"> *</span>
                                </label>
                                <select required class="js-example-basic-multiple" name="role_permissions[]" multiple="multiple"> 
                                    @foreach ($permissions as $permission)
                                    <option @if($role->hasPermissionTo($permission->name)) selected @endif>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <a style="margin-right:3px;" href="{{ url('view-roles') }}" class="btn btn-danger btn-sm">Cancel</a>
                                <input type="submit" class="btn btn-success btn-sm">
                            </div>
                        </div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Select2 cdn -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
<!-- Input Mask -->
<script src="{{ URL::asset('assets/libs/cleave.js/cleave.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-masks.init.js') }}"></script>
<!-- App JS -->
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

<script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
@endsection