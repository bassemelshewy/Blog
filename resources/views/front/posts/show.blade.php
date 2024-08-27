@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="col-12">
            <div class="box">
                <div class="box-header no-border d-flex justify-content-between">
                    <h3 class="box-title">{{ $post->title }}</h3>
                    @if (auth()->id() === $post->user_id)
                        <div class="d-flex">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm me-2">
                                Update Post
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete Post
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="box">
                <div class="box-body wizard-content">
                    <p class="my-10">
                        <span class="d-block mb-2"><i class="fa fa-user"></i> <strong> By {{ $post->user->name }} </strong>
                        </span>
                        <span class="d-block mb-2"><i class="fa fa-calendar"></i> <strong>
                                {{ $post->created_at->format('M d, Y') }} </strong> </span>
                        <span class="d-block">
                            <i class="fa fa-comment"></i>
                            <strong id="commentsCount">
                            </strong>
                        </span>
                    </p>

                    <div class="pt-25">
                        <p>
                            {{ $post->content }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-body">
                <h3>Comments</h3>
                <div id="comments-list">
                </div>
            </div>
        </div>

        <div class="box">
            <div class="box-body">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h3 class="box-title">Add Comment</h3>
                </div>
                <form class="form" id="addCommentForm" novalidate>
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Content: <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" placeholder="Enter content here"
                                            required minlength="5"></textarea>
                                    </div>
                                    @error('content')
                                        <span class="input-group-text text-danger border-danger mt-5">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
        </div>

        </div>
    </section>
@stop


@section('scripts')
    <script>
        $(document).ready(function() {
            var token = "{{ csrf_token() }}";
            var postId = {{ $post->id }};

            function fetchComments() {
                var URL = "{{ route('comments.fetch', ':postId') }}";
                URL = URL.replace(':postId', postId);
                $.ajax({
                    url: URL,
                    type: 'GET',
                    success: function(response) {
                        var commentsHtml = '';
                        var commentsCount = response.comments.length;
                        $('#commentsCount').text(commentsCount + ' Comments');
                        if (response.comments && response.comments.length > 0) {
                            $.each(response.comments, function(index, comment) {
                                commentsHtml += '<div class="card mb-2">';
                                commentsHtml +=
                                    '<div class="card-body d-flex justify-content-between">';
                                commentsHtml += '<p><strong>' + comment.user.name +
                                    ': </strong>' + comment.content + '</p>';

                                if (comment.user_id === {{ auth()->id() }}) {
                                    // commentsHtml += '<form method="POST" action="' + '{{ route('comments.destroy', '') }}' + '/' + comment.id + '" onsubmit="return confirmDelete();">';
                                    // commentsHtml += '@csrf';
                                    // commentsHtml += '@method('DELETE')';
                                    commentsHtml +=
                                        '<button type="submit" class="btn btn-danger btn-sm deleteComment" data-id="' +
                                        comment.id + '">Delete</button>'
                                    // commentsHtml += '</form>';
                                }

                                commentsHtml += '</div>';
                                commentsHtml += '</div>';
                            });
                        } else {
                            commentsHtml = '<p><strong>No comments available.</strong></p>';
                        }
                        $('#comments-list').html(commentsHtml);
                    },
                    error: function(xhr, status, error) {
                        var responseData = JSON.parse(xhr.responseText);

                        if (responseData.errors) {
                            var errorMessage = '';
                            $.each(responseData.errors, function(key, value) {
                                errorMessage += value + '<br>';
                            });
                            toastr.error(errorMessage, 'Validation Error', {
                                progressBar: true
                            });
                        } else {
                            toastr.error(responseData.message, 'Error', {
                                progressBar: true
                            });
                        }
                    }
                });
            }

            fetchComments();

            function deleteComment(commentId) {
                var URL = "{{ route('comments.destroy', ':commentId') }}";
                URL = URL.replace(':commentId', commentId);

                $.ajax({
                    url: URL,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success', {
                            progressBar: true
                        });
                        fetchComments();
                    },
                    error: function(xhr, status, error) {
                        var responseData = JSON.parse(xhr.responseText);
                        if (xhr.status === 403) {
                            toastr.error(responseData.message, 'Authorization Error', {
                                progressBar: true
                            });
                        } else {
                            toastr.error(responseData.message, 'Error', {
                                progressBar: true
                            });
                        }
                    }
                });
            }

            $('#comments-list').on('click', '.deleteComment', function() {
                var commentId = $(this).data('id');
                if (confirm('Are you sure you want to delete this comment?')) {
                    deleteComment(commentId);
                }
            })

            $('#addCommentForm').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                // console.log('Form Data:', formData);

                var URL = "{{ route('comments.store', ':postId') }}";
                URL = URL.replace(':postId', postId);

                $.ajax({
                    type: 'POST',
                    url: URL,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    dataType: 'json',
                    success: function(response) {
                        toastr.success(response.message, 'Success', {
                            progressBar: true
                        });
                        $('#addCommentForm')[0].reset();
                        fetchComments();
                    },
                    error: function(xhr, status, error) {
                        var responseData = JSON.parse(xhr.responseText);

                        if (responseData.errors) {
                            var errorMessage = '';
                            $.each(responseData.errors, function(key, value) {
                                errorMessage += value + '<br>';
                            });
                            toastr.error(errorMessage, 'Validation Error', {
                                progressBar: true
                            });
                        } else {
                            toastr.error(responseData.message, 'Error', {
                                progressBar: true
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this post?');
        }
    </script>
@stop
