<?php

namespace App\Repositories\Comment;

use App\Helpers\ResponderHelper;
use App\Models\Comment;

class CommentEloquent implements CommentInterface
{
    public function __construct(protected Comment $comment)
    {
    }

    public function fetchComments(int $postId)
    {
        return $this->comment::where('post_id', $postId)->with('user')->get();
    }
    
    public function show(int $id){
        return $this->comment::findOrFail($id);
    }
    public function store(array $data)
    {
        return $this->comment->create($data);
    }

    public function delete(int $id)
    {
        return $this->comment->where('id', $id)->delete();
    }
}
