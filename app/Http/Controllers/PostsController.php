<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Repositories\Post\PostInterface;
use Illuminate\Auth\Access\AuthorizationException;

class PostsController extends Controller
{
    public function __construct(protected PostInterface $post)
    {
    }

    public function index(){
        $posts = $this->post->index();
        // dd($posts);
        return view('front.posts.index', compact('posts'));
    }

    public function create(){
        return view('front.posts.create');
    }

    public function store(CreateRequest $request){
        try {
            $inputs = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(),
            ];
            // dd($inputs);
            $this->post->store($inputs);
            toastr()->success('Saved Successfully');
            return redirect()->route('posts.index');
        }catch (\Exception $e){
            toastr()->error('Something went wrong');
            return redirect()->route('posts.index');
        }
    }

    public function show(int $id){
        try{
            $post = $this->post->show($id);
            return view('front.posts.show', compact('post'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            toastr()->error('Something went wrong');
            return redirect()->route('posts.index');
        }
    }

    public function edit($id)
    {
        try {
            $post = $this->post->show($id);
            $this->authorize('update', $post);

            return view('front.posts.edit', compact('post'));
        }catch(AuthorizationException $e){
            toastr()->error('You are not authorized to edit this post');
            return redirect()->route('posts.show', $id);
        }catch (\Exception $e) {
            // dd($e->getMessage());
            toastr()->error('Something went wrong');
            return redirect()->route('posts.index');
        }
    }

    public function update(int $id, UpdateRequest $request){
        try{
            $post = $this->post->show($id);
            $this->authorize('update', $post);
            $inputs = [
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id()
            ];
            $this->post->update($id, $inputs);
            toastr()->success('Post updated successfully');
            return redirect()->route('posts.show', $id);
        } catch(AuthorizationException $e){
            toastr()->error('You are not authorized to update this post');
            return redirect()->route('posts.show', $id);
        } catch (\Exception $e) {
            toastr()->error('Something went wrong');
            return redirect()->route('posts.index');
        }
    }

    public function delete(int $id){
        try{
            $post = $this->post->show($id);
            $this->authorize('delete', $post);

            $this->post->delete($id);
            toastr()->success('Post deleted successfully');
            return redirect()->route('posts.index');
        } catch(AuthorizationException $e){
            toastr()->error('You are not authorized to delete this post');
            return redirect()->route('posts.show', $id);
        } catch (\Exception $e) {
            toastr()->error('Something went wrong');
            return redirect()->route('posts.index');
        }
    }
}
