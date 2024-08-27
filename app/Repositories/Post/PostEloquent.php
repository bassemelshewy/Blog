<?php

namespace App\Repositories\Post;

use App\Helpers\ResponderHelper;
use App\Models\Post;

class PostEloquent implements PostInterface
{
    public function __construct(protected Post $post)
    {
    }

    public function index()
    {
        $posts = $this->post::with('user')->withCount('comments')->latest()->paginate(10);
        return $posts;
    }

    public function store(array $data)
    {
        return $this->post->create($data);
    }

    public function show(int $id)
    {
        return $this->post->findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $post = $this->show($id);
        $post->update($data);
        return $post;
    }

    public function delete(int $id)
    {
        return $this->post->where('id', $id)->delete();
    }
}
