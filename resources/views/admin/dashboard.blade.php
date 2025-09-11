@extends('admin.layouts.app')

@section('content')<!-- main panel -->
    <div class="main-panel">

        <div class="content-wrapper">
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 pd_0">
                            <h3 class="page-title">
                                <span class="page-title-icon badge-primary text-white me-2">
                                    <i class="fa fa-dashboard menu-icon"></i>
                                </span> Dashboard
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 text-center">
                @include('admin.includes.alert')
            </div>

            <div class="card">
                <div class="card-body table-container">
                    <div class="dashboard-card">
                        <div class="row">

                            @if(Auth::guard('admin')->user()->user_type != MEMBER)
                                <div class="col-md-3">
                                    <div class="card bg-primary card-img-holder text-white">
                                        <a href="{{ route('admin.user.list') }}" target="_blank" class="text-white">
                                            <div class="card-body">
                                                <img src="{{ assets_url('images/dashboard', 'circle.svg') }}"
                                                    class="card-img-absolute" alt="circle-image" />
                                                <h2 class="mb-2">
                                                    {{ $users }}
                                                    <i class="fa fa-users"></i>
                                                </h2>
                                                <h4 class="mb-2">
                                                    Total {{ (Auth::guard('admin')->user()->user_type == SUPER_ADMIN) ? "Client" : "Team Member" }}
                                                </h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-3">
                                <div class="card bg-success card-img-holder text-white">
                                    <a href="{{ route('admin.url.list') }}" target="_blank" class="text-white">
                                        <div class="card-body">
                                            <img src="{{ assets_url('images/dashboard', 'circle.svg') }}"
                                                class="card-img-absolute" alt="circle-image" />
                                            <h2 class="mb-2">
                                                {{ $urls }}
                                                <i class="fa fa-link"></i>
                                            </h2>
                                            <h4 class="mb-2">
                                                Total URLs
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.includes.footer')
    </div>

@endsection