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
                                        <i class="fa fa-link" aria-hidden="true"></i> Generate Short URL
                                    </h3>
                                </div>
                                <div class="col-12 col-md-2 d-flex justify-content-start justify-content-md-end">
                                    <a href="{{ route('admin.url.list') }}" class="btn btn-primary" style="">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <center>@include('admin.includes.alert')</center>
                            </div>
                            <form class="" method="POST" action="{{ route('admin.url.store') }}"
                                enctype="multipart/form-data" id="add_url" name="add_url">
                                @csrf

                                <div class="form-group">
                                    <label for="original_url">Long URL <span class="required_field">*</span></label>
                                    <input type="link" name="original_url" class="form-control @error('original_url') is-invalid @enderror"
                                        id="original_url" placeholder="Enter original url"
                                        value="{{ old('original_url', request()->input('original_url')) }}">
                                    @error('original_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('admin.url.list') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.includes.footer')
    </div>
@endsection