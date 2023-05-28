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

You can easy get telegram entities from Request

```php 
   class TelegramHookController extends Controller
   {


        public function hook(Request $request)
        {
            $message = Message::fromRequest($request);
            if($message){
                $command = Command::extractCommandAndParamsFromMessage($message->getText());
                if($command){
                    dump($command->getCommand());
                    dump($command->getParams());
                    // something with command and params
                }
            }

        }
   }

```

```php 
namespace App\Http\Controllers;

use Antonosipov\TelegramCommon\InlineQuery;
use Antonosipov\TelegramCommon\InlineQueryResults\InlineQueryResultArticle;
use Antonosipov\TelegramCommon\InputMessageContent;
use Antonosipov\TelegramCommon\TelegramService;
use Illuminate\Http\Request;

class TelegramHookController extends Controller
{

    public function __construct(readonly private TelegramService $telegramService)
    {
    }

    public function hook(Request $request)
    {
        $query = InlineQuery::fromRequest($request);
        if ($query && $query->getChatType() == 'private') {
           $this->telegramService->answerInlineQuery($query->getId(), [
               new InlineQueryResultArticle(1, 'Привет', 'Нет', new InputMessageContent('Привет'))
           ]);
        }

    }
}


```
