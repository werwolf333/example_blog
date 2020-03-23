<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class CommentRepository
{
    public function getMessageById($messageId)
    {
        $comments = DB::select(
            'SELECT c.text, u.name userName, c.id
            FROM comments c
            LEFT JOIN users u on c.user_id = u.id
            WHERE c.message_id = :message_id', 
            [
                'message_id' => $messageId
            ]
        );
    return $comments;
    }

    public function saveMessage($user, $messageId, $text)
    {
        DB::select(
            'INSERT INTO comments(user_id, message_id, text) VALUES(:user_id, :message_id, :text)',
            [
                'user_id' => $user->id,
                'message_id' => $messageId,
                'text' => $text,
            ]
        );
    }

    public function deleteComment($messageId, $commentId)
    {
        DB::select(
            'DELETE FROM comments WHERE message_id=:messageId and id=:commentId',
            ['messageId' => $messageId,
            'commentId' => $commentId]
        );
    }
    public function editComment($messageId, $commentId)
    {
        $comments = DB::select(
            'select * FROM comments WHERE message_id=:messageId and id=:commentId',
            ['messageId' => $messageId,
            'commentId' => $commentId]
        );
        return $comments;
    }
    public function updateComment($messageId, $commentId, $text)
    {
        $comments = DB::select(
            'update comments
            SET text =:text
            WHERE message_id=:messageId and id=:commentId',
            ['messageId' => $messageId,
            'commentId' => $commentId,
            'text' =>$text
            ]
        );
    }
}