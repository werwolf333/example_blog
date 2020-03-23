<?php

namespace App\Http\Controllers;

use App\Repository\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController
{
    /** @var MessageRepository */
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    function index()
    {
        $messages =  $this->messageRepository->getMessages();

        return view('message/messages', ['messages' => $messages]);
    }

    function create()
    {
          return view('message/create');
    }

    function store(Request $request)
    {
        $title = $request->get('title');
        $text = $request->get('text');

        $user = Auth::user();
        $userId = $user->id;

        $this->messageRepository->saveMessage($userId, $title, $text);

        return redirect('/messages');
    }

    function delete($messageId)
    {
        $this->messageRepository->deleteMessage($messageId);
        return redirect('/messages');
    }

    function edit($messageId)
    {
        $message = $this->messageRepository->getMessageById($messageId);
        return view('message/edit', ['message' => $message]);
    }

    function update($messageId, Request $request)
    {
        $title = $request->get('title');
        $text = $request->get('text');
        $this->messageRepository->updateMessage($messageId, $title, $text);
        return redirect('/messages');
    }

}
