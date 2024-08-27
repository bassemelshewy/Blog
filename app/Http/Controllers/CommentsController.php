<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\CreateRequest;
use App\Notifications\CommentAdded;
use App\Repositories\Comment\CommentInterface;
use App\Repositories\Post\PostInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentsController extends Controller
{
    public function __construct(protected CommentInterface $comment, protected PostInterface $post)
    {
    }

    public function fetchComments(int $postId){
        try {
            $comments = $this->comment->fetchComments($postId);
            return response()->json(['comments' => $comments], 200);
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Somethig went wrong'], 500);
        }
    }

    public function store(CreateRequest $request, int $postId){
        try{
            $inputs = [
                'content' => $request->content,
                'user_id' => auth()->id(),
                'post_id' => $postId
            ];

            $comment = $this->comment->store($inputs);

            $post = $this->post->show($postId);

            if($post && $post->user){
                $post->user->notify(new CommentAdded($comment));
            }

            return response()->json(['message' => 'Comment added successfully'], 200);
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function delete(int $id){
        try{
            $comment = $this->comment->show($id);
            $this->authorize('delete', $comment);

            $this->comment->delete($id);
            return response()->json(['message' => 'Deleted successfully']);
        } catch(AuthorizationException $e){
            return response()->json(['message' => 'You are not authorized to delete this comment'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }
}
