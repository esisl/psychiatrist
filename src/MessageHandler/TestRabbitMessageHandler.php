<?php

namespace App\MessageHandler;

use App\Message\TestRabbitMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class TestRabbitMessageHandler
{
    public function __invoke(TestRabbitMessage $message): void
    {
        // do something with your message
    }
}
