<?php

namespace Antonosipov\TelegramCommon;

class InputMessageContent
{
    private string $message_text;
    private string $parse_mode = 'HTML';
    private bool $disable_web_page_preview;

    /**
     * @param string $message_text
     * @param string $parse_mode
     * @param bool $disable_web_page_preview
     */
    public function __construct(string $message_text, string $parse_mode = 'HTML', bool $disable_web_page_preview = true)
    {
        $this->message_text = $message_text;
        $this->parse_mode = $parse_mode;
        $this->disable_web_page_preview = $disable_web_page_preview;
    }

    public function toArray(): array
    {
        return [
            'message_text' => $this->message_text,
            'parse_mode' => $this->parse_mode,
            'disable_web_page_preview' => $this->disable_web_page_preview,
        ];
    }


}
