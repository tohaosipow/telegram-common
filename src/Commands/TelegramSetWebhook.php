<?php

namespace Antonosipov\TelegramCommon\Commands;

use App\Services\TelegramService;
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
  protected $description = 'Set app url + api/hook as webhook';

  /**
   * Execute the console command.
   */
  public function handle(): void
  {
    $route = $this->argument('route');
    App::make(TelegramService::class)->setWebhook($route);
  }
}
