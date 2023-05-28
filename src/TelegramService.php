<?php

namespace App\Services;



use Antonosipov\TelegramCommon\InlineQueryResults\InlineQueryResult;
use Antonosipov\TelegramCommon\Keyboard\InlineReplyMarkup;
use Antonosipov\TelegramCommon\Message;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    /**
     * @param string $inline_query_id
     * @param InlineQueryResult[] $results
     * @param int $cache_time
     * @param string|null $switch_pm_text
     * @param bool $is_personal
     * @param string|null $switch_pm_parameter
     * @return object
     */
    public function answerInlineQuery(string $inline_query_id, array $results, int $cache_time = 300, string $switch_pm_text = null, bool $is_personal = true, string $switch_pm_parameter = null): object
    {
        return $this->request('answerInlineQuery', [
            'inline_query_id' => $inline_query_id,
            'results' => $this->toArray($results),
            'switch_pm_parameter' => $switch_pm_parameter,
            'switch_pm_text' => $switch_pm_text,
            'is_personal' => $is_personal,
            'cache_time' => $cache_time,
        ]);
    }

    public function answerCallbackQuery(int $callback_query_id, string $text, bool $show_alert): object
    {
        return $this->request('answerCallbackQuery',
            [
                'callback_query_id' => $callback_query_id,
                'text' => $text,
                'show_alert' => $show_alert
            ]);
    }

    public function editMessageText(string $text, ?string $chat_id = null, ?InlineReplyMarkup $inlineReplyMarkup = null, ?int $message_id = null, ?string $inline_message_id = null, string $parse_mode = 'HTML', bool $disable_web_page_preview = true): object
    {
        return $this->request('editMessageText', [
            'text' => $text,
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'inline_message_id' => $inline_message_id,
            'parse_mode' => $parse_mode,
            'disable_web_page_preview' => $disable_web_page_preview,
            'reply_markup' => $inlineReplyMarkup?->toArray(),
        ]);
    }

    public function editMessageReplyMarkup(Message $message, ?InlineReplyMarkup $inlineReplyMarkup = null, string $parse_mode = 'HTML', bool $disable_web_page_preview = true): object
    {
        return $this->request('editMessageReplyMarkup', [
            'chat_id' => $message->getChat()->getId(),
            'message_id' => $message->getMessageId(),
            'reply_markup' => $inlineReplyMarkup?->toArray(),
        ]);
    }


    public function sendMessage($user, string $text, ?InlineReplyMarkup $inlineReplyMarkup = null, ?int $message_id = null, ?string $inline_message_id = null, string $parse_mode = 'HTML', bool $disable_web_page_preview = true, ?string $video = null): object
    {
        if ($video) {
            return $this->request('sendVideo', [
                'caption' => $text,
                'video' => $video,
                'chat_id' => $user->telegram_id,
                'parse_mode' => $parse_mode,
                'disable_web_page_preview' => $disable_web_page_preview,
                'reply_markup' => $inlineReplyMarkup?->toArray(),
            ]);
        }
        return $this->request('sendMessage', [
            'text' => $text,
            'chat_id' => $user->telegram_id,
            'parse_mode' => $parse_mode,
            'disable_web_page_preview' => $disable_web_page_preview,
            'reply_markup' => $inlineReplyMarkup?->toArray(),
        ]);
    }

    /**
     * @param Arrayable[] $array
     * @return array
     */
    private function toArray(array $array): array
    {
        return array_map(fn($el) => $el->toArray(), $array);
    }

    public function setWebhook()
    {
        return $this->request('setWebhook', [
            'url' => env('APP_URL') . '/api/hook'
        ]);
    }

    private function request(string $method, array $params): object
    {
        $token = config('common_telegram.token');
        $response = Http::post("https://api.telegram.org/$token/$method", array_filter($params));
        $result = $response->object();
        if (!$result->ok && $method != 'editMessageText') {
            Log::error("Can't process $method request to telegram", ['response' => var_export($result, true)]);
        }
        return $result;
    }


    public function deleteMessageByChatIdAndMessageId(int $chat_id, int $message_id): object
    {
        return $this->request('deleteMessage', ['chat_id' => $chat_id, 'message_id' => $message_id]);
    }

    public function deleteMessage(Message $message): object
    {
        return $this->request('deleteMessage', ['chat_id' => $message->getChat()->getId(), 'message_id' => $message->getMessageId()]);
    }
}
