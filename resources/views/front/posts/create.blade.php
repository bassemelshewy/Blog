@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h3 class="page-title">Create New</h3>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body wizard-content">
                <form class="form" method="POST" action="{{ route('posts.store') }}" novalidate>
                    @csrf
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Title: <span class="text-danger">*</span></label>
                                <div class="controls">
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Blog Title"
                                        value="{{ old('title') }}" required minlength="3">
                                </div>
                                @error('title')
                                    <span class="input-group-text text-danger border-danger mt-5">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Content: <span class="text-danger">*</span></label>
                                <div class="controls">
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                            placeholder="Enter content here" required minlength="10">{{ old('content') }}</textarea>
                                </div>
                                @error('content')
                                    <span class="input-group-text text-danger border-danger mt-5">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="javascript:history.back()" class="btn btn-warning me-1">
                            <i class="ti-trash"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@stop
