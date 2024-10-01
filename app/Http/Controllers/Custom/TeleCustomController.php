<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use WeStacks\TeleBot\Objects\Update;
use WeStacks\TeleBot\TeleBot;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\BotCommand;


class TeleCustomController extends Controller
{

    private $bot1;
   

    public function __construct()
    {
        $this->bot1 = new TeleBot(DataSite('telegram_token_tb'));
        
    }
    
    public function bot(){
        return $this->bot1;
    }

    public function bot1()
    {
        return $this->bot1;
    }
   


    public function setWebhook()
    {
        $url = 'https://' . getDomain() . '/callback/telegram/v1';
        // $url = 'https://gotosub.net/callback/telegram/v1';
        return $this->bot1->setWebhook([
            'url' => $url,
        ]);
    }

    public function getWebhookInfo()
    {
        dd($this->bot1->getWebhookInfo());
    }

    public function deleteWebhook()
    {
        $this->bot1->deleteWebhook();
        return response()->json([
            'status' => 'success',
            'message' => 'delete webhook success'
        ]);
    }

    public function getMe()
    {
        return $this->bot1->getMe();
    }

    public function getUpdates()
    {
        dd($this->bot1->getUpdates());
    }

    public function getCommands()
    {
        dd($this->bot1->getMyCommands());
    }

    public function sendMessage($text, $reply_markup = null)
    {
        return $this->bot1->sendMessage([
            'chat_id' => DataSite('telegram_chat_id'),
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]);
    }
    


    public function sendPhoto($chat_id, $text, $photo)
    {
        return $this->bot1->sendPhoto([
            'chat_id' => $chat_id,
            'text' => $text,
            'photo' => $photo,
        ]);
    }



    public function sendDocument($chat_id, $document)
    {
        return $this->bot1->sendDocument([
            'chat_id' => $chat_id,
            'document' => $document,
        ]);
    }

    public function sendVideo($chat_id, $video)
    {
        return $this->bot1->sendVideo([
            'chat_id' => $chat_id,
            'video' => $video,
        ]);
    }

    public function sendAudio($chat_id, $audio)
    {
        return $this->bot1->sendAudio([
            'chat_id' => $chat_id,
            'audio' => $audio,
        ]);
    }

    public function sendVoice($chat_id, $voice)
    {
        return $this->bot1->sendVoice([
            'chat_id' => $chat_id,
            'voice' => $voice,
        ]);
    }

    public function sendAnimation($chat_id, $animation)
    {
        return $this->bot1->sendAnimation([
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

        $this->bot1->setMyCommands([
            'commands' => $commands
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'set commands success'
        ]);
    }

    public function deleteMyCommands()
    {
        $this->bot1->deleteMyCommands();
        return response()->json([
            'status' => 'success',
            'message' => 'delete commands success'
        ]);
    }
}
