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
                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                    <a type="button" class="btn btn-sm btn-danger" title="Delete" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $course->id }}">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                @endif
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
                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                    <a type="button" title="Edit" href="{{ route('editcourse', $course->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="ri-pencil-line"></i>
                                    </a>
                                @endif
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
                                            @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                <a class="btn btn-sm
                                            btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#addproductModal">
                                                    <i class="ri-add-line align-bottom me-1"></i> Add Assignment
                                                </a>
                                            @endif
                                            <div class="modal fade" id="addproductModal" tabindex="-1"
                                                aria-labelledby="addproductModalLabel">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addproductModalLabel">Add
                                                                Assignment
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div
                                                            class="modal-body
                                                    ">
                                                            <form method="POST" action="{{ route('storeassignment') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="title" class="form-label">Title
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                            name="title" placeholder="Enter Title">
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="due_date" class="form-label">Due Date
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <input type="date" class="form-control"
                                                                            name="due_date" placeholder="Select Date">
                                                                    </div>
                                                                    <div class="col-md-12 mb-3">
                                                                        <label for="file" class="form-label">File
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <input type="file" class="form-control"
                                                                            name="file" placeholder="Select File">
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
                                            @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                <a class="btn btn-sm
                                            btn-secondary"
                                                    data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                                                    <i class="ri-add-line align-bottom me-1"></i> Add Material
                                                </a>
                                            @endif

                                            <div class="modal fade
                                            "
                                                id="addMaterialModal" tabindex="-1"
                                                aria-labelledby="addMaterialModalLabel">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addMaterialModalLabel">Add
                                                                Material
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div
                                                            class="modal-body
                                                    ">
                                                            <form method="POST" action="{{ route('storematerial') }}"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="title" class="form-label">Title
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                            name="title" placeholder="Enter Title">
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="file" class="form-label">File
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <input type="file" class="form-control"
                                                                            name="file" placeholder="Select File">
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
                                            @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addStudentModal{{ $course->id }}">
                                                    <i class="ri-user-2-line align-bottom me-1"></i> Add Student
                                                </a>
                                            @endif
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
                                            @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                <a type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#attendanceModal{{ $course->id }}">
                                                    Create Attendance
                                                </a>
                                            @endif
                                            <div class="modal fade" id="attendanceModal{{ $course->id }}"
                                                tabindex="-1" aria-labelledby="attendanceModalLabel{{ $course->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="attendanceModalLabel{{ $course->id }}">Create
                                                                Attendance</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                action="{{ route('storeeattendance') }}">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="date" class="form-label">Date
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <input type="date" class="form-control"
                                                                            name="date" placeholder="Select Date">
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label for="date" class="form-label">Time
                                                                            <span style="color: red"> *</span>
                                                                        </label>
                                                                        <input type="time" class="form-control"
                                                                            name="date" placeholder="Select Date">
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
                                        {{-- <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" id="searchProductList"
                                                    placeholder="Search...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div> --}}
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
                                                    Assignments <span
                                                        class="badge badge-soft-danger align-middle rounded-pill ms-1"></span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-mat" role="tab">
                                                    Materials <span
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
                                            <form class="m-5" action="{{ route('storediscussion') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="msg"
                                                            placeholder="Type your message">
                                                    </div>
                                                    <input type="hidden" name="course" value="{{ $course->id }}">
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-primary">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @foreach ($discussions as $discussion)
                                                <div class="mx-5">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h5 class="card-title">Sent By:
                                                                {{ $discussion->user->username }}</h5>
                                                        </div>
                                                        <div class="ms-auto">
                                                            @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                                <a type="button" class="btn btn-sm btn-danger"
                                                                    title="Delete" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteDiscussionModal{{ $discussion->id }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </a>
                                                            @elseif(Auth::user()->id == $discussion->user->id)
                                                                <a type="button" class="btn btn-sm btn-danger"
                                                                    title="Delete" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteDiscussionModal{{ $discussion->id }}">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </a>
                                                            @endif
                                                            <!-- Modal -->
                                                            <div class="modal fade
                                                            "
                                                                id="deleteDiscussionModal{{ $discussion->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="deleteDiscussionModalLabel{{ $discussion->id }}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="deleteDiscussionModalLabel{{ $discussion->id }}">
                                                                                Delete Discussion
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div
                                                                            class="modal-body
                                                                            ">
                                                                            <p>Are you sure you want to delete this
                                                                                discussion?</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <a type="submit"
                                                                                href="{{ route('deletediscussion', $discussion->id) }}"
                                                                                class="btn btn-danger">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="card-text">{{ $discussion->msg }}</p>
                                                </div>
                                                <hr class="mx-5">
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="productnav-published" role="tabpanel">
                                        <div id="table-product-list-published" class="table-card gridjs-border-none">
                                            @foreach ($assignments as $assignment)
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5
                                                                    class="card-title
                                                                ">
                                                                    {{ $assignment->title }}</h5>
                                                            </div>
                                                            <div class="col-auto">
                                                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                                    <a type="button" class="btn btn-sm btn-danger"
                                                                        title="Delete" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteAssignmentModal{{ $assignment->id }}">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
                                                                @endif
                                                                <div class="modal fade
                                                                    "
                                                                    id="deleteAssignmentModal{{ $assignment->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="deleteAssignmentModalLabel{{ $assignment->id }}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="deleteAssignmentModalLabel{{ $assignment->id }}">
                                                                                    Delete Assignment
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div
                                                                                class="modal-body
                                                                                ">
                                                                                <p>Are you sure you want to delete this
                                                                                    assignment?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <a type="submit"
                                                                                    href="{{ route('deleteassignment', $assignment->id) }}"
                                                                                    class="btn btn-danger">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="card-text">Due Date: {{ $assignment->due_date }}
                                                                </p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <a href="{{ route('downloadassignment', $assignment->id) }}"
                                                                    class="btn btn-sm btn-primary">Download</a>
                                                                @if (Auth::user()->hasRole('Student'))
                                                                    <a class="btn btn-sm btn-success" title="Upload"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#uploadAssignment">

                                                                        Upload
                                                                        Assignment
                                                                    </a>
                                                                    <div class="modal fade" id="uploadAssignment"
                                                                        tabindex="-1"
                                                                        aria-labelledby="uploadAssignmentLabel">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="uploadAssignmentLabel">Upload
                                                                                        Assignment
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form method="POST"
                                                                                        action="{{ route('uploadassignment') }}"
                                                                                        enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        @method('POST')
                                                                                        <div class="row">

                                                                                            <div class="col-md-12 mb-3">
                                                                                                <label for="file"
                                                                                                    class="form-label">File
                                                                                                    <span
                                                                                                        style="color: red">
                                                                                                        *</span>
                                                                                                </label>
                                                                                                <input type="file"
                                                                                                    class="form-control"
                                                                                                    name="file"
                                                                                                    placeholder="Select File">
                                                                                            </div>
                                                                                            <input type="hidden"
                                                                                                name="assignment_id"
                                                                                                value="{{ $assignment->id }}">
                                                                                            <div
                                                                                                class="col-md-12 form-group mb-2">
                                                                                                <a style="margin-right:3px;"
                                                                                                    href=""
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
                                                                @endif
                                                            </div>


                                                        </div>
                                                        @if (Auth::user()->hasRole('Student'))
                                                            @php
                                                                $studentAssignment = App\Models\StudentAssignment::where(
                                                                    'assignment_id',
                                                                    $assignment->id,
                                                                )
                                                                    ->where('student_id', Auth::user()->id)
                                                                    ->first();
                                                            @endphp
                                                            @if ($studentAssignment)
                                                            <h5>Uploaded Assignments</h5>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <p class="card-text">Upload Date:
                                                                            {{ $studentAssignment->created_at }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <a href="{{ route('downloadstudentassignment', $studentAssignment->id) }}"
                                                                            class="btn btn-sm btn-primary">Download</a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @else
                                                            @php
                                                                $studentAssignments = App\Models\StudentAssignment::where(
                                                                    'assignment_id',
                                                                    $assignment->id,
                                                                )->get();
                                                            @endphp
                                                            @foreach ($studentAssignments as $studentAssignment)
                                                            <h5>Student Assignments</h5>
                                                            @php
                                                                $student = App\Models\User::find($studentAssignment->student_id);

                                                            @endphp
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <p class="card-text">Upload Date:
                                                                            {{ $studentAssignment->created_at }}
                                                                        </p>
                                                                        <p class="card-text">Student Name:
                                                                            {{ $student->username }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <a href="{{ route('downloadstudentassignment', $studentAssignment->id) }}"
                                                                            class="btn btn-sm btn-primary">Download</a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="productnav-mat" role="tabpanel">
                                        <div id="table-product-list-published" class="table-card gridjs-border-none">
                                            @foreach ($materials as $material)
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5
                                                                    class="card-title
                                                                ">
                                                                    {{ $material->title }}</h5>
                                                            </div>
                                                            <div class="col-auto">
                                                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                                    <a type="button" class="btn btn-sm btn-danger"
                                                                        title="Delete" data-bs-toggle="modal"
                                                                        data-bs-target="#deletematerialModal{{ $material->id }}">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
                                                                @endif
                                                                <div class="modal fade
                                                                    "
                                                                    id="deletematerialModal{{ $material->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="deletematerialModalLabel{{ $material->id }}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="deletematerialModalLabel{{ $material->id }}">
                                                                                    Delete material
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div
                                                                                class="modal-body
                                                                                ">
                                                                                <p>Are you sure you want to delete this
                                                                                    material?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <a type="submit"
                                                                                    href="{{ route('deletematerial', $material->id) }}"
                                                                                    class="btn btn-danger">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <p class="card-text">Upload Date:
                                                                    {{ $assignment->created_at }}
                                                                </p>
                                                            </div>
                                                            <div class="col-auto">
                                                                <a href="{{ route('downloadassignment', $assignment->id) }}"
                                                                    class="btn btn-sm btn-primary">Download</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="productnav-draft" role="tabpanel">
                                        <div class="py-4 text-center">
                                            <table id="datatable"
                                                class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th>Email</th>
                                                        @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                            <th>Actions</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($course->students as $student)
                                                        <tr>
                                                            <td>{{ $student->username }}</td>
                                                            <td>{{ $student->email }}</td>
                                                            <td>
                                                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                                    <a type="button" class="btn btn-sm btn-danger"
                                                                        title="Delete" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteStudentModal{{ $student->id }}">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
                                                                @endif
                                                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                                    <a class="btn btn-sm btn-primary" title="Edit"
                                                                        href="{{ route('edituser', encrypt($student->id)) }}">
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                @endif
                                                                <div class="modal fade
                                                                    "
                                                                    id="deleteStudentModal{{ $student->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="deleteStudentModalLabel{{ $student->id }}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="deleteStudentModalLabel{{ $student->id }}">
                                                                                    Delete Student
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div
                                                                                class="modal-body
                                                                                ">
                                                                                <p>Are you sure you want to delete this
                                                                                    student?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <form
                                                                                    action="{{ route('removestudentfromcourse') }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('POST')
                                                                                    <input type="hidden" name="student"
                                                                                        value="{{ $student->id }}">
                                                                                    <input type="hidden" name="course"
                                                                                        value="{{ $course->id }}">
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">Delete</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="productnav-att" role="tabpanel">
                                        <div class="py-4 text-center">
                                            <table id="datatable"
                                                class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Present</th>
                                                        <th>Absent</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($attendances as $attendance)
                                                        <tr>
                                                            <td>{{ $attendance->date }}</td>
                                                            <td>{{ $attendance->time }}</td>
                                                            @php
                                                                $present = 0;
                                                                $absent = 0;
                                                                //get total present and absent students
                                                                foreach ($attendance->studentAttendance as $att) {
                                                                    if ($att->status == 'present') {
                                                                        $present++;
                                                                    } else {
                                                                        $absent++;
                                                                    }
                                                                }
                                                            @endphp
                                                            <td>{{ $present }}</td>
                                                            <td>{{ $absent }}</td>
                                                            <td>
                                                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                                    <a type="button" data-bs-toggle="modal"
                                                                        data-bs-target="#info{{ $attendance->id }}">
                                                                        <i class="ri-information-line text-success"></i>
                                                                    </a>
                                                                    <div class="modal fade
                                                                    "
                                                                        id="info{{ $attendance->id }}" tabindex="-1"
                                                                        aria-labelledby="infoLabel{{ $attendance->id }}">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="infoLabel{{ $attendance->id }}">
                                                                                        Attendance Date:
                                                                                        {{ $attendance->date }}
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div
                                                                                    class="modal-body
                                                                                ">
                                                                                    <table class="table table-bordered">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Student Name</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            @foreach ($attendance->studentAttendance as $att)
                                                                                                <tr>
                                                                                                    @php
                                                                                                        $student = App\Models\User::find(
                                                                                                            $att->student_id,
                                                                                                        );
                                                                                                    @endphp
                                                                                                    <td>{{ $student->username }}
                                                                                                    </td>
                                                                                                    <td>{{ $att->status }}
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                {{-- <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <a href="{{ route('deleteattendance', $attendance->id) }}"
                                                                                    class="btn btn-danger">Delete</a>
                                                                            </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @elseif(Auth::user()->hasRole('Student'))
                                                                    @php
                                                                        $status = 'absent';

                                                                        $studentAttendance = App\Models\StudentAttendance::where(
                                                                            'attendance_id',
                                                                            $attendance->id,
                                                                        )
                                                                            ->where('student_id', Auth::user()->id)
                                                                            ->first();
                                                                        if ($studentAttendance) {
                                                                            $status = $studentAttendance->status;
                                                                        }
                                                                    @endphp
                                                                    @if ($status == 'present')
                                                                        <span class="badge bg-success">Present</span>
                                                                    @else
                                                                        <span class="badge bg-danger">Absent</span>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                                                    <a type="button" class="btn btn-sm btn-danger"
                                                                        title="Delete" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteAttendanceModal{{ $attendance->id }}">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
                                                                @elseif(Auth::user()->hasRole('Student'))
                                                                    <a class="btn btn-sm btn-secondary"
                                                                        href="{{ route('presentstudent', $attendance->id) }}"
                                                                        title="Present">
                                                                        <i class=" ri-check-line"></i>
                                                                    </a>
                                                                    <a class="btn btn-sm btn-danger"
                                                                        href="{{ route('absentstudent', $attendance->id) }}"
                                                                        title="Absent">
                                                                        <i class="ri-close-line"></i>
                                                                    </a>
                                                                @endif
                                                                <div class="modal fade
                                                                    "
                                                                    id="deleteAttendanceModal{{ $attendance->id }}"
                                                                    tabindex="-1"
                                                                    aria-labelledby="deleteAttendanceModalLabel{{ $attendance->id }}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="deleteAttendanceModalLabel{{ $attendance->id }}">
                                                                                    Delete Attendance
                                                                                </h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div
                                                                                class="modal-body
                                                                                ">
                                                                                <p>Are you sure you want to delete this
                                                                                    attendance?</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <a href="{{ route('deleteattendance', $attendance->id) }}"
                                                                                    class="btn btn-danger">Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
