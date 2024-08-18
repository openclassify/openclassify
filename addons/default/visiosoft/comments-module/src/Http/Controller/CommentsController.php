<?php namespace Visiosoft\CommentsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\CommentsModule\Comment\CommentModel;

class CommentsController extends PublicController
{
    public function saveComment()
    {
        $comment = new CommentModel([
            'title' => request()->title,
            'username' => request()->username,
            'entry_id' => request()->entry,
            'entry_type' => request()->entry_type,
            'rating' => request()->rating,
            'detail' => request()->detail,
        ]);
        if($comment->save()){
            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => false]);
        }
    }
}
