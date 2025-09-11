@extends('admin.layouts.app')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">

                            <div class="brand-logo">
                                <div class="col-md-12 text-center">
                                    <img src="{{ assets_url('images', 'logo.png') }}" alt="logo" /><br>
                                </div>
                            </div>
                            <h4>Hello! let's get started</h4>
                            <div class="col-md-12">
                                <center>@include('admin.includes.alert')</center>
                            </div>
                            <h6 class="font-weight-light">
                                Sign in to continue.</h6>
                            <form class="pt-3" method="POST" action="{{ route('admin.login.submit') }}" id="admin_login">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                        value="{{ old('email') }}" placeholder="Enter Email" autofocus>
                                    @error('email')
                                        <div class="help-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="exampleInputPassword1" placeholder="Enter Password">
                                    @error('password')
                                        <div class="help-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mt-3 text-center">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Sign
                                        In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

@section('scripts')
    <script>
        $('#admin_login').bootstrapValidator({
            excluded: ':disabled, :hidden',
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: "The email address is required and cannot be empty"
                        },
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: "The password is required and cannot be empty"
                        }
                    }
                }
            }
        })
    </script>
@endsection