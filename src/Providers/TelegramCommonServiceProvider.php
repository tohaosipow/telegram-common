<?php
namespace Antonosipov\TelegramCommon\Providers;

use Antonosipov\TelegramCommon\Commands\TelegramSetWebhook;
use Illuminate\Support\ServiceProvider;

class TelegramCommonServiceProvider extends ServiceProvider
{
  public function boot()
  {
    if ($this->app->runningInConsole()) {
      $this->commands([
        TelegramSetWebhook::class,
      ]);
    }
    
    $this->publishes([
      __DIR__ . '/../Config/config.php' => config_path('common_telegram.php'),
    ], 'common_telegram');

    // use the vendor configuration file as fallback
    $this->mergeConfigFrom(
      __DIR__ . '/../Config/config.php', 'common_telegram'
    );
  }
}