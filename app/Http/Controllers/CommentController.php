<?php

namespace App\Http\Controllers;
use App\Repository\MessageRepository;
use App\Repository\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController
{
    /** @var MessageRepository */
    private $messageRepository;
    /** @var CommentRepository */
    private $commentRepository;

    public function __construct(MessageRepository $messageRepository, CommentRepository $commentRepository)
    {
        $this->messageRepository = $messageRepository;
        $this->commentRepository = $commentRepository;
    }    
    
    function index($messageId)
    {
        $message = $this->messageRepository->getMessageById($messageId);

        if (empty($message)) {
            return response()->view('404', [], 404);
        }

        $comments = $this->commentRepository->getMessageById($messageId);

        return view('message/message', [
            'message' => $message,
            'comments' => $comments
        ]);
    }

    function create($messageId)
    {
          return view('comment/create', ['messageId' => $messageId]);
    }

    function store($messageId , Request $request)
    {
        $text = $request->get('text');

        $user = Auth::user();

        $this->commentRepository->saveMessage($user, $messageId, $text);

        return redirect("/messages/$messageId");
    }

    function delete($messageId, $commentId)
    {
        $this->commentRepository->deleteComment($messageId, $commentId);
        return redirect("/messages/$messageId");
    }

    function edit($messageId, $commentId)
    {
        $comments = $this->commentRepository->editComment($messageId, $commentId);

        return view("comment/edit", ['comment'=>$comments[0], 'messageId'=>$messageId]);
    }  

    function update($messageId, $commentId, Request $request)
    {
        $text = $request->get('text');
        $this->commentRepository->updateComment($messageId, $commentId, $text);

        return redirect("/messages/$messageId");
    }  

}