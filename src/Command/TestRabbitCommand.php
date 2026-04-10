<?php

namespace App\Command;

use App\Message\TestRabbitMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'test:rabbit',
    description: 'Отправляет тестовое сообщение в RabbitMQ',
)]
class TestRabbitCommand extends Command
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        parent::__construct();
        $this->bus = $bus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = new TestRabbitMessage('Проверка связи ' . date('H:i:s'));
        $this->bus->dispatch($message);

        $output->writeln('<info>✅ Сообщение успешно отправлено в очередь RabbitMQ</info>');
        return Command::SUCCESS;
    }
}