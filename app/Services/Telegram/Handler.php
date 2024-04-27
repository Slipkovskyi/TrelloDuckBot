<?php

namespace App\Services\Telegram;

use App\Models\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        $telegramUser = $this->message->toArray()['from'];

        $this->reply("Привет, " . $telegramUser['first_name'] . "!");

        if (User::where('username', $telegramUser['username'])->exists()) {
            $this->reply('Вы уже зарегистрированы.');
            return;
        }

        $user = new User();
        $user->first_name = $telegramUser['first_name'];
        $user->last_name = $telegramUser['last_name'];
        $user->username = $telegramUser['username'];
        $user->language_code = $telegramUser['language_code'];
        if ($user->save()) {
            $this->reply('Вы успешно зарегистрированы.');
        } else {
            $this->reply('Ошибка регистрации.');
        }
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->reply('Эй! Я не имею такой команды.');
    }
}
