<?php

namespace Antonosipov\TelegramCommon\InlineQueryResults;

use Antonosipov\TelegramCommon\InputMessageContent;
use Antonosipov\TelegramCommon\Keyboard\InlineReplyMarkup;

class InlineQueryResultArticle extends InlineQueryResult
{



    protected function getType()
    {
        return 'article';
    }

    public function toArray(): array
    {
        $parent = parent::toArray();
        return array_merge($parent, [
        ]);
    }
}
