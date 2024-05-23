@extends('layouts.master')
@section('title')
    @lang('translation.dashboards')
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Courses</p>
                                </div>
                                <div class="flex-shrink-0">
                                    {{-- <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                        +16.24 %
                                    </h5> --}}
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                            data-target="{{ $courseCount }}">0</span>
                                    </h4>
                                    {{-- <a href="" class="text-decoration-underline">net
                                        earnings</a> --}}
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="ri-draft-line text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Students</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-danger fs-14 mb-0">
                                            {{-- <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                        -3.57 % --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="{{ $studentCount }}">0</span></h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-secondary rounded fs-3">
                                            <i class="ri-user-2-line text-secondary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                @endif
                @if (Auth::user()->hasRole('Super Admin'))
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Teachers</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">

                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="{{ $teacherCount }}">0</span>
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-success rounded fs-3">
                                            <i class="ri-user-6-fill text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                @endif
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Assignments</p>
                                </div>
                                <div class="flex-shrink-0">
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                            data-target="{{ $assignmentCount }}">0</span>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                        <i class="bx bx-wallet text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->
        </div>


    </div>
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class=" mb-0">Activities</h3>
            </div><!-- end cardheader -->
            <div class="card-body pt-0">
                @if (Auth::user()->hasRole('Super Admin') || Auth::user()->hasRole('Teacher'))
                    <h4 class="card-title mb-0">
                        @if (Auth::user()->hasRole('Super Admin'))
                            Recent Users
                        @else
                            Recent Students
                        @endif
                    </h4>
                    @foreach ($users as $user)
                        <div class="mini-stats-wid d-flex align-items-center mt-3">
                            <div class="flex-shrink-0 avatar-sm">
                                <span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                    {{ $user->username[0] }}
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">
                                    <p>{{ $user->username }}</p>
                                </h6>
                                <p class="text-muted mb-0">
                                <p>{{ $user->email }}</p>
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">
                                    {{ $user->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div><!-- end -->
                    @endforeach
                    <hr>
                @endif
                <h4 class="card-title mt-3">
                    Recent Courses
                </h4>
                @foreach ($courses as $course)
                    <div class="mini-stats-wid d-flex align-items-center mt-3">
                        <div class="flex-shrink-0 avatar-sm">
                            <span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                {{ $course->name[0] }}
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">
                                <p>{{ $course->name }}</p>
                            </h6>
                            <p class="text-muted mb-0">
                            <p>{{ $course->teacher->username }}</p>
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">
                                {{ $course->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div><!-- end -->
                @endforeach
                <hr>
                <h4 class="card-title mt-3">
                    Recent Assignments
                </h4>
                @foreach ($assignments as $assignment)
                    <div class="mini-stats-wid d-flex align-items-center mt-3">
                        <div class="flex-shrink-0 avatar-sm">
                            <span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                {{ $assignment->title[0] }}
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">
                                <p>{{ $assignment->title }}</p>
                            </h6>
                            <p class="text-muted mb-0">
                            <p>{{ $assignment->due_date }}</p>
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">
                                {{ $assignment->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div><!-- end -->
                @endforeach
                <hr>
                <h4 class="card-title mt-3">
                    Recent Material Upload
                </h4>
                @foreach ($materials as $material)
                    <div class="mini-stats-wid d-flex align-items-center mt-3">
                        <div class="flex-shrink-0 avatar-sm">
                            <span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                {{ $material->title[0] }}
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">
                                <p>{{ $material->title }}</p>
                            </h6>
                            <p class="text-muted mb-0">
                            <p>{{ $material->user->username }}</p>
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">
                                {{ $material->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div><!-- end -->
                @endforeach
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
@endsection
@section('script')
    <!-- apexcharts -->
    {{-- <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>


    <script src="{{ URL::asset('/assets/js/pages/dashboard-projects.init.js') }}"></script>


    <script>
        function pickVal() {

            console.log(calendar);
        }
    </script>
@endsection
