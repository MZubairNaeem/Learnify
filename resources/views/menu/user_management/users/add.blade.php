@extends('layouts.master')
@section('title') User @endsection

@section('css')
<!-- Select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Breadcrumb Trail -->
@component('components.breadcrumb')
@slot('li_1')
    Users
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
                <h1 class="card-title mb-0">Add User</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <form method="POST" action="{{ route('storeuser') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username
                                    <span style="color: red"> *</span>
                                </label>
                                <input required type="text" class="form-control" name="username" placeholder="Username">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email
                                    <span style="color: red"> *</span>
                                </label>
                                <input
                                type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password
                                    <span style="color: red"> *</span>
                                </label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" aria-label=".form-select-sm example"
                                    name="role"
                                >
                                    <option selected>Select Role</option>
                                    @foreach ($roles as $role)
                                        @if ($role->name != 'Super Admin')
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group mb-2">
                                <a style="margin-right:3px;" href="{{ route('viewusers') }}" class="btn btn-danger btn-sm">Cancel</a>
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