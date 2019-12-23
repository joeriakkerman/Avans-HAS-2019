<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * @param Request $request
     *      point_id: id of the interest point
     *      text: comment for this point
     */
    public function addComment(Request $request){
        $comment = new Comment;
        $comment->fill(["point_id" => $request["point_id"],
                        "text" => $request["text"]]);
        $comment->save();
        return redirect()->back();
    }

    /**
     * @param Request $request
     *      id: id of the comment which needs to be removed
     */
    public function removeComment(Request $request){
        $comment = Comment::find($request["id"]);
        if(isset($comment) && !empty($comment)){
            $comment->delete();
        }
        return redirect()->back();
    }
}
