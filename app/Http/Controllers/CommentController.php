<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(CommentRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        return Comment::firstOrCreate($data);
    }

    public function show($id) {

        $comment = Comment::find($id);

        return $comment;
    }

    public function create(CommentRequest $request)
    {

        $data = $request->validated();


        $comment = Comment::create($data);


        return $comment;
    }

    public function update(CommentRequest $request, $id)
    {
        $data = $request->validated();

        $comment = Comment::find($id);

        $comment->update($data);

        return $comment;
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        // Если продукт не найден, возвращаем ошибку 404
        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found',
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully',
        ], 200);
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found',
            ], 404);
        }

        return $comment;  // HTTP статус 200: OK
    }
}
