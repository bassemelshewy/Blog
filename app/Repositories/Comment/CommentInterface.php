<?php

namespace App\Repositories\Comment;

interface CommentInterface
{
    public function store(array $data);
    public function fetchComments(int $postId);
    public function show(int $id);
    public function delete(int $id);
}
