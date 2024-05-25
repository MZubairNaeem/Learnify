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
            List
        @endslot
    @endcomponent
    @include('partials.session')
    <div class="row mb-2">
        <div class="col-12">
            <div class="text-end">
                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                    <a href="{{ route('addcourse') }}" class="btn btn-primary waves-effect waves-light">
                        <i class="ri-add-line align-middle me-2"></i> Add Course
                    </a>
                @else
                    <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#enroll">
                        <i class="ri-add-line align-middle me-2"></i> Enroll Course
                    </a>
                    <div class="modal fade
                                " id="enroll" tabindex="-1"
                        aria-labelledby="enrollLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="enrollLabel">Enroll
                                        Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body
                                            ">
                                    <form method="POST" action="{{ route('enrollcourse') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <input type="text" required class="form-control" name="code"
                                                placeholder="Enter Course Code">
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
                @endif
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($courses as $course)
                @php
                    $isExpired = false;
                    $today = date('Y-m-d');
                    if ($course->end_date < $today) {
                        $isExpired = true;
                    }
                @endphp
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between">
                                <div class="col">
                                    <h3 class="card-title text-primary text-bold">{{ $course->name }}
                                        @if ($isExpired)
                                            <span class="badge bg-danger">
                                                Unavailable
                                            </span>
                                        @endif
                                    </h3>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-info" href="{{ route('showcourse', $course->id) }}">
                                        <i class="ri-eye-line"></i>
                                    </a>
                                    @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                        <a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
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
                                                <div
                                                    class="modal-body
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
                                        <a type="button" href="{{ route('editcourse', $course->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col d-flex justify-content-between mt-2">
                                <p class="card-text text-secondary fs-16">{{ $course->teacher->username }}</p>
                                <p class="card-text">{{ $course->code }}</p>
                            </div>
                        </div>
                        <div class="card-body ">
                            <div class="col d-flex justify-content-between">
                                <p class="card-text text-dark">Created By</p>
                                <p class="card-text">{{ $course->creator->username }}</p>
                            </div>
                            <div class="col d-flex justify-content-between">
                                <p class="card-text text-dark">Start Date</p>
                                <p class="card-text">{{ $course->start_date }}</p>
                                <p class="card-text text-dark">End Date</p>
                                <p class="card-text">{{ $course->end_date }}</p>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <p class="card-text text-dark">Total Students</p>
                                </div>
                                <div class="col-auto d-flex">
                                    <p class="card-text mx-3">
                                        {{ $course->students->count() }}
                                    </p>
                                    @if (!$isExpired)
                                        @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                            <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#addStudentModal{{ $course->id }}">
                                                <i class="ri-user-add-line"></i>
                                            </a>
                                        @endif
                                    @endif
                                    <div class="modal fade" id="addStudentModal{{ $course->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalgridLabel">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addStudentModalLabel">Add Student to
                                                        Course
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div
                                                    class="modal-body
                                                    ">
                                                    <form method="POST" action="{{ route('addstudenttocourse') }}">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="student" class="form-label">Student
                                                                    <span style="color: red"> *</span>
                                                                </label>
                                                                <select class="form-select" name="student" required>
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
                                                                <input type="submit" class="btn btn-success btn-sm">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!$isExpired)
                                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                                    <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#attendanceModal{{ $course->id }}">
                                        Create Attendance
                                    </a>
                                @endif
                            @endif
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
                        </div>
                    </div>
                </div>
            @endforeach
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
