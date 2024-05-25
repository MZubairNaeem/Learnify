@extends('layouts.master')
@section('title')
    Course
@endsection

@section('css')
    <!-- Select2 css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Breadcrumb Trail -->
    @component('components.breadcrumb')
        @slot('li_1')
            Course
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
                    <h1 class="card-title mb-0">Add Course</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form method="POST" action="{{ route('storecourse') }}">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="form-label">Course Name
                                        <span style="color: red"> *</span>
                                    </label>
                                    <input required type="text" class="form-control" name="name"
                                        placeholder="Course Name">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="code" class="form-label">Course Code
                                        <span style="color: red"> *</span>
                                    </label>
                                    <input required type="text" class="form-control" name="code"
                                        placeholder="Course Code">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="teacher" class="form-label">Teacher
                                        <span style="color: red"> *</span>
                                    </label>
                                    <select class="form-select" name="teacher" required>
                                        <option value="">Select Teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label for="startDate" class="form-label">
                                        Start Date<span style="color: red"> *</span>
                                    </label>
                                    <input type="date" required class="form-control" name="startDate"
                                        placeholder="Select Start Date">

                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label for="endDate" class="form-label">
                                        End Date<span style="color: red"> *</span>
                                    </label>
                                    <input type="date" required class="form-control" name="endDate"
                                        placeholder="Select Start Date">

                                </div>
                                <div class="col-md-12 form-group mb-2">
                                    <a style="margin-right:3px;" href="" class="btn btn-danger btn-sm">Cancel</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
