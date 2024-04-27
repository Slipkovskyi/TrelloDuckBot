<?php

namespace App\Http\Controllers;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\Request;

class TrelloController extends Controller
{
    public function sendUpdateCards(Request $request)
    {
        TelegraphChat::all()->each(function ($chatInfo) use ($request){
            $chat = new TelegraphChat();
            $chat->chat_id = $chatInfo->chat_id;
            $chat->message($request->getContent())->send();
        });
    }
}
