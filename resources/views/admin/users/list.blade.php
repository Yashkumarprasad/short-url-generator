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
                                    <i class="fa fa-users menu-icon"></i>
                                </span> {{ (Auth::guard('admin')->user()->user_type == SUPER_ADMIN) ? "Client" : "Team Member" }} Manager
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
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                @if(Auth::guard('admin')->user()->user_type != SUPER_ADMIN)
                                    <th>Role</th>
                                @endif
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$users->isEmpty())
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        @if(Auth::guard('admin')->user()->user_type != SUPER_ADMIN)
                                            <td>
                                                {{ ucfirst($user['user_type']) }}
                                            </td>
                                        @endif
                                        <td>{{ convertToAppTimezone($user['created_at']) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10" style="text-align: center;">
                                        No Data Found
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        @include('admin.includes.footer')
    </div>

@endsection