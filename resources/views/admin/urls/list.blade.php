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
                                    <i class="fa fa-link menu-icon"></i>
                                </span> URLs Manager
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
                                <th>Original URL</th>
                                <th>Short URL</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$urls->isEmpty())
                                @foreach ($urls as $url)
                                    <tr>
                                        <td>{{ $loop->iteration + $urls->firstItem() - 1 }}</td>
                                        <td>
                                            <a href="{{ $url['original_url'] }}" target="_blank">
                                                {{ $url['original_url'] }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('url.redirect-url', ['code' => $url['code']]) }}"
                                                target="_blank">
                                                {{ route('url.redirect-url', ['code' => $url['code']]) }}
                                            </a>
                                        </td>
                                        <td>{{ convertToAppTimezone($url['created_at']) }}</td>
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
                    {{ $urls->links() }}
                </div>
            </div>
        </div>

        @include('admin.includes.footer')
    </div>

@endsection