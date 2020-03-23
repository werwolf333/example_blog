<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

class MessageRepository
{
    public function getMessageById($messageId)
    {
        $messages = DB::select(
            'SELECT m.id, m.title, m.text, u.name, m.created_at createdAt
            FROM messages m
            LEFT JOIN users u on m.user_id = u.id
            WHERE m.id = :message_id',
            [
                'message_id' => $messageId
            ]
        );

        if (count($messages) <= 0) {
            return null;
        }

        return $messages[0];
    }

    public function getMessages()
    {
        $messages = DB::select(
            'SELECT m.id id, m.title, m.text, u.name, m.created_at createdAt, count(c.id) commentsCount
            FROM messages m 
            LEFT JOIN users u on m.user_id = u.id
            LEFT JOIN comments c on m.id = c.message_id
            GROUP BY m.id , m.title, m.text, u.name, m.created_at
            ORDER BY m.created_at DESC'
        );

        return $messages;
    }

    public function saveMessage($userId, $title, $text)
    {
        DB::select(
            'INSERT INTO messages(user_id, title, text) VALUES(:userId, :title, :text)',
            [
                'userId' => $userId,
                'title' => $title,
                'text' => $text,
            ]
        );
    }

    public function deleteMessage($messageId)
    {
        DB::select(
            'DELETE FROM messages WHERE id=:messageId',
            ['messageId' => $messageId]
        );
    }

    public function updateMessage($messageId, $title, $text)
    {
        DB::select(
            'UPDATE messages
            SET title = :title, 
            text = :text
            WHERE id = :messageId',
            [
                'messageId' => $messageId,
                'title' => $title,
                'text' => $text
            ]
        );
    }

    public function topCountComments()
    {
        DB::select(
            'SELECT title, text, created_at
            FROM messages
            WHERE (SELECT user_id 
            FROM (SELECT user_id, COUNT(user_id)
            FROM comments
            GROUP BY user_id
			order by COUNT(user_id) DESC 
            limit 1) step)' 

        );


        DB::select(
            'SELECT user_id 
            FROM (SELECT user_id, COUNT(user_id)
            FROM comments
            GROUP BY user_id
			order by COUNT(user_id) DESC 
            limit 1) step'
        );
    }



}
