<?php

namespace Antonosipov\TelegramCommon\Keyboard;

class InlineKeyboardButton
{
    private string $text;
    private ?string $url;
    private ?array $callback_data;
    private ?string $switch_inline_query;

    /**
     * @param string $text
     * @param string|null $url
     * @param array|null $callback_data
     * @param bool|null $switch_inline_query
     */
    public function __construct(string $text, ?string $url = null, ?array $callback_data = null, ?string $switch_inline_query = null)
    {
        $this->text = $text;
        $this->url = $url;
        $this->callback_data = $callback_data;
        $this->switch_inline_query = $switch_inline_query;
    }

    /**
     * @param string $text
     */


    /**
     * @param string $text
     * @return InlineKeyboardButton
     */
    public function setText(string $text): InlineKeyboardButton
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param string|null $url
     * @return InlineKeyboardButton
     */
    public function setUrl(?string $url): InlineKeyboardButton
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param array $callback_data
     * @return InlineKeyboardButton
     */
    public function setCallbackData(array $callback_data): InlineKeyboardButton
    {
        $this->callback_data = $callback_data;
        return $this;
    }

    /**
     * @param string|null $switch_inline_query
     * @return InlineKeyboardButton
     */
    public function setSwitchInlineQuery(?string $switch_inline_query): InlineKeyboardButton
    {
        $this->switch_inline_query = $switch_inline_query;
        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'text' => $this->text,
            'url' => $this->url,
            'callback_data' => isset($this->callback_data) ? json_encode($this->callback_data) : null,
            'switch_inline_query' => $this->switch_inline_query ?? null
        ]);
    }


}
