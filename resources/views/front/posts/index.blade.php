@extends('layouts.app')

@section('styles')
    <style>
        .box-text {
            height: 80px;
            overflow: hidden;
        }
    </style>
@stop

@section('content')
<section class="content">
    <div class="col-12">
        <div class="box">
            <div class="box-header no-border d-flex justify-content-between">
                <h3 class="box-title">All Posts</h3>
                <a href="{{ route('posts.create') }}" class="btn btn-info btn-sm">
                    Add Post
                </a>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-body">
                            <div class="text-start">
                                <h4 class="box-title">{{ $post->title }}</h4>
                                <p class="my-10">
                                    <small>
                                    <i class="fa fa-user"></i> By {{ $post->user->name }}
                                    | <i class="fa fa-calendar"></i> {{ $post->created_at->format('M d, Y') }}
                                    | <i class="fa fa-comment"></i> {{ $post->comments_count }} Comments
                                    </small>
                                </p>
                                <p class="box-text">
                                    {{ Str::limit($post->content, 100) }}
                                </p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-flat btn-primary btn-sm">Show Post</a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 mt-4 d-flex justify-content-center">
        {{ $posts->links('vendor.pagination.custem-pagination') }}
    </div>
</section>
@stop
