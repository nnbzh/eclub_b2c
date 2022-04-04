<?php

namespace App\Console\Commands\Parsers;

use App\Models\CancelMessage;
use App\Repositories\Api\EclubRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseCancelMessagesCommand extends Command
{
    protected $signature = 'parse:cancel-messages';
    protected $description = 'Parses cancel messages from shop';

    public function __construct(private EclubRepository $eclubRepository)
    {
        parent::__construct();
    }

    public function handle()
    {
        try {
            $messages = $this->eclubRepository->getCancelMessages()['data'] ?? [];
            foreach ($messages as $message) {
                $message['message'] = json_encode($message['message'], JSON_UNESCAPED_UNICODE);
                $message['is_active'] = $message['status'] == 1;
                unset(
                    $message['status'],
                    $message['lft'],
                    $message['rgt'],
                    $message['depth'],
                    $message['old_message'],
                    $message['created_at'],
                    $message['updated_at'],
                );

                if (! CancelMessage::query()->find($message['id'])) {
                    CancelMessage::query()->insert([$message]);
                }
            }

            $this->info("Successfully parsed cancel messages");
            Log::info("Successfully parsed cancel messages");
        } catch (\Exception $e) {
            $this->error('Failed while cancel messages');
            Log::error('Failed while cancel messages', ['Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine(),]);
        }
    }
}
