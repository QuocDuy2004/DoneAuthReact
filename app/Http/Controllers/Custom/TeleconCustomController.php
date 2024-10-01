<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use WeStacks\TeleBot\Objects\Update;
use WeStacks\TeleBot\TeleBot;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\BotCommand;


class TeleconCustomController extends Controller
{

    private $bot2;
   

    public function __construct()
    {
        $this->bot2 = new TeleBot(DataSite1('telegram_token_tb'));
        
    }

    public function bot2()
    {
        return $this->bot2;
    }
   


    public function setWebhook()
    {
        $url = 'https://' . getDomain() . '/callback/telegram/v1';
        // $url = 'https://gotosub.net/callback/telegram/v1';
        return $this->bot2->setWebhook([
            'url' => $url,
        ]);
    }

    public function getWebhookInfo()
    {
        dd($this->bot2->getWebhookInfo());
    }

    public function deleteWebhook()
    {
        $this->bot2->deleteWebhook();
        return response()->json([
            'status' => 'success',
            'message' => 'delete webhook success'
        ]);
    }

    public function getMe()
    {
        return $this->bot2->getMe();
    }

    public function getUpdates()
    {
        dd($this->bot2->getUpdates());
    }

    public function getCommands()
    {
        dd($this->bot2->getMyCommands());
    }

    public function sendMessage($chat_id,$text, $reply_markup = null)
    {
        return $this->bot2->sendMessage([
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]);
    }
    


    public function sendPhoto($chat_id, $text, $photo)
    {
        return $this->bot2->sendPhoto([
            'chat_id' => $chat_id,
            'text' => $text,
            'photo' => $photo,
        ]);
    }



    public function sendDocument($chat_id, $document)
    {
        return $this->bot2->sendDocument([
            'chat_id' => $chat_id,
            'document' => $document,
        ]);
    }

    public function sendVideo($chat_id, $video)
    {
        return $this->bot2->sendVideo([
            'chat_id' => $chat_id,
            'video' => $video,
        ]);
    }

    public function sendAudio($chat_id, $audio)
    {
        return $this->bot2->sendAudio([
            'chat_id' => $chat_id,
            'audio' => $audio,
        ]);
    }

    public function sendVoice($chat_id, $voice)
    {
        return $this->bot2->sendVoice([
            'chat_id' => $chat_id,
            'voice' => $voice,
        ]);
    }

    public function sendAnimation($chat_id, $animation)
    {
        return $this->bot2->sendAnimation([
            'chat_id' => $chat_id,
            'animation' => $animation,
        ]);
    }

    // command
    public function setMyCommands()
    {
        $commands = [
            new BotCommand([
                'command' => 'help',
                'description' => 'Hướng dẫn sử dụng'
            ]),
            new BotCommand([
                'command' => 'set',
                'description' => 'Xác thực Token'
            ]),
        ];

        $this->bot2->setMyCommands([
            'commands' => $commands
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'set commands success'
        ]);
    }

    public function deleteMyCommands()
    {
        $this->bot2->deleteMyCommands();
        return response()->json([
            'status' => 'success',
            'message' => 'delete commands success'
        ]);
    }
}
