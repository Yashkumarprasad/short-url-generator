@extends('admin.layouts.app')

@section('content')
    <div class="main-panel">

        <div class="content-wrapper">

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10 m_auto">
                                    <h3 class="page-title">
                                        <i class="fa fa-users" aria-hidden="true"></i> Invite New {{ (Auth::guard('admin')->user()->user_type == SUPER_ADMIN) ? "Client" : "Team Member" }}
                                    </h3>
                                </div>
                                <div class="col-12 col-md-2 d-flex justify-content-start justify-content-md-end">
                                    <a href="{{ route('admin.user.list') }}" class="btn btn-primary" style="">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <center>@include('admin.includes.alert')</center>
                            </div>
                            <form class="" method="POST" action="{{ route('admin.user.store') }}"
                                enctype="multipart/form-data" id="add_user" name="add_user">
                                @csrf

                                @if(Auth::guard('admin')->user()->user_type != SUPER_ADMIN)
                                    <div class="form-group">
                                        <label for="role">Role <span class="required_field">*</span></label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="{{ ADMIN }}">Admin</option>
                                            <option value="{{ MEMBER }}">Member</option>
                                        </select>
                                        @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="name">Name <span class="required_field">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="Enter Name"
                                        value="{{ old('name', request()->input('name')) }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email <span class="required_field">*</span></label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="Enter Email" value="{{ old('email', request()->input('email')) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('admin.user.list') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.includes.footer')
    </div>
@endsection