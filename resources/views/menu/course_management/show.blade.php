@extends('layouts.master')
@section('title')
    Courses
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
            Course
        @endslot
        @slot('title')
            View
        @endslot
    @endcomponent
    @include('partials.session')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-between">
                            <div class="col">
                                <h3 class="card-title fs-20 text-primary text-bold"title="Course Name">{{ $course->name }}
                                </h3>
                            </div>
                            <div>
                                <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#attendanceModal{{ $course->id }}">
                                    Create Attendance
                                </a>
                                <div class="modal fade
                                "
                                    id="attendanceModal{{ $course->id }}" tabindex="-1"
                                    aria-labelledby="attendanceModalLabel{{ $course->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="attendanceModalLabel{{ $course->id }}">Create
                                                    Attendance</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body
                                            ">
                                                <form method="POST" action="{{ route('storeeattendance') }}">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="date" class="form-label">Date
                                                                <span style="color: red"> *</span>
                                                            </label>
                                                            <input type="date" class="form-control" name="date"
                                                                placeholder="Select Date">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="date" class="form-label">Time
                                                                <span style="color: red"> *</span>
                                                            </label>
                                                            <input type="time" class="form-control" name="date"
                                                                placeholder="Select Date">
                                                        </div>
                                                        <input type="hidden" name="course" value="{{ $course->id }}">
                                                        <div class="col-md-12 form-group mb-2">
                                                            <a style="margin-right:3px;" href=""
                                                                class="btn btn-danger btn-sm">Cancel</a>
                                                            <input type="submit" class="btn btn-success btn-sm">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a type="button" class="btn btn-sm btn-danger" title="Delete" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $course->id }}">
                                    <i class="ri-delete-bin-line"></i>
                                </a>
                                <div class="modal fade
                                    "
                                    id="deleteModal{{ $course->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $course->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $course->id }}">Delete
                                                    Course</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body
                                                ">
                                                <p>Are you sure you want to delete this course?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <form method="POST" action="{{ route('deletecourse', $course->id) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="course" value="{{ $course->id }}">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a type="button" title="Edit" href="{{ route('editcourse', $course->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="ri-pencil-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="col d-flex justify-content-between">
                            <p title="Teacher Name">
                                Teacher Name: {{ $course->teacher->username }}
                            </p>
                            <p class="" title="Course Code">Course Code: {{ $course->code }}</p>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <p title="Total Students">
                                Total Students: {{ $course->students->count() }}
                            </p>
                            <p title="Created By">Created By: {{ $course->creator->username }}</p>
                        </div>
                        <div class="row d-flex justify-content-between">
                            <div title="Course Start Date" class="col-auto">
                                <label for="startDate">Start Date</label>
                                <p>{{ $course->start_date }}</p>
                            </div>
                            <div title="Course End Date" class="col-auto">
                                <label for="endDate">End Date</label>
                                <p>{{ $course->end_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="apps-ecommerce-add-product" class="btn btn-sm btn-primary"
                                                id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Add
                                                Assignment</a>
                                            <a href="apps-ecommerce-add-product" class="btn btn-sm btn-success"
                                                id="addproduct-btn"><i class="ri-upload-2-line align-bottom me-1"></i>
                                                Upload
                                                Material</a>
                                            <a type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#addStudentModal{{ $course->id }}">
                                                <i class="ri-user-2-line align-bottom me-1"></i> Add Student
                                            </a>
                                            <div class="modal fade" id="addStudentModal{{ $course->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalgridLabel">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addStudentModalLabel">Add Student
                                                                to Course
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div
                                                            class="modal-body
                                                    ">
                                                            <form method="POST"
                                                                action="{{ route('addstudenttocourse') }}">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="student" class="form-label">Student
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <select class="form-select" name="student"
                                                                            required>
                                                                            <option value="">Select Student</option>
                                                                            @foreach ($students as $student)
                                                                                <option value="{{ $student->id }}">
                                                                                    {{ $student->username }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <input type="hidden" name="course"
                                                                        value="{{ $course->id }}">
                                                                    <div class="col-md-12 form-group mb-2">
                                                                        <a style="margin-right:3px;" href=""
                                                                            class="btn btn-danger btn-sm">Cancel</a>
                                                                        <input type="submit"
                                                                            class="btn btn-success btn-sm">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" id="searchProductList"
                                                    placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-all" role="tab">
                                                    Discussion <span
                                                        class="badge badge-soft-danger align-middle rounded-pill ms-1"></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-published" role="tab">
                                                    Uploads <span
                                                        class="badge badge-soft-danger align-middle rounded-pill ms-1"></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-draft" role="tab">
                                                    Students
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-att" role="tab">
                                                    Attendance
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <div id="selection-element">
                                            <div class="my-n1 d-flex align-items-center text-muted">
                                                Select <div id="select-content" class="text-body fw-semibold px-1"></div>
                                                Result <button type="button" class="btn btn-link link-danger p-0 ms-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#removeItemModal">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">

                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                        <div id="table-product-list-all" class="table-card gridjs-border-none">

                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="productnav-published" role="tabpanel">
                                        <div id="table-product-list-published" class="table-card gridjs-border-none">

                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="productnav-draft" role="tabpanel">
                                        <div class="py-4 text-center">
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="productnav-att" role="tabpanel">
                                        <div class="py-4 text-center">
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
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
