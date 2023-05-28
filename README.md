# Telegram Common for Laravel

### How to install
```bash
   composer require antonosipov/telegram-common
```

```
 php artisan vendor:publish --provider="Antonosipov\TelegramCommon\Providers\TelegramCommonServiceProvider"
```

Add to .env
```
  TELEGRAM_TOKEN=<token_here>
```
or change env variable in ```config/telegram-common.php```

### Config

You can get telegram entities from Request easy, example echo-bot:

```php 

namespace App\Http\Controllers;

use Antonosipov\TelegramCommon\Message;
use Antonosipov\TelegramCommon\TelegramService;
use Illuminate\Http\Request;

class TelegramHookController extends Controller
{


    public function __construct(protected TelegramService $telegramService)
    {
    }

    public function hook(Request $request)
    {
        $message = Message::fromRequest($request);
        if($message){
            $this->telegramService->sendMessage($message->getChat()->getId(), $message->getText());
        }

    }
}


```
