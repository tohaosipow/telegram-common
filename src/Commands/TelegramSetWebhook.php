<?php

namespace Antonosipov\TelegramCommon\Commands;

use Antonosipov\TelegramCommon\TelegramService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class TelegramSetWebhook extends Command
{

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'telegram:webhook {route}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Set app url + route params as webhook';

  public function __construct(protected TelegramService $telegramService)
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   */
  public function handle(): void
  {
    $route = $this->argument('route');
    $this->telegramService->setWebhook($route);
  }
}
