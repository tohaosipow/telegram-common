<?php

namespace Antonosipov\TelegramCommon\InlineQueryResults;

use Antonosipov\TelegramCommon\InputMessageContent;
use Antonosipov\TelegramCommon\Keyboard\InlineReplyMarkup;
use Illuminate\Contracts\Support\Arrayable;

abstract class InlineQueryResult implements Arrayable
{
    protected string $id;
    protected ?InlineReplyMarkup $reply_markup;
    protected string $title;
    protected string $description;
    protected InputMessageContent $input_message_content;

    private ?string $thumbnail_url;

    /**
     * @param string $id
     * @param string $title
     * @param string $description
     * @param InlineReplyMarkup|null $reply_markup
     */
    public function __construct(
        string              $id,
        string              $title,
        string              $description,
        InputMessageContent $input_message_content,
        InlineReplyMarkup   $reply_markup = null)
    {
        $this->id = $id;
        $this->reply_markup = $reply_markup;
        $this->title = $title;
        $this->description = $description;
        $this->input_message_content = $input_message_content;
    }

    protected abstract function getType();

    /**
     * @param string|null $thumbnail_url
     * @return InlineQueryResult
     */
    public function setThumbnailUrl(?string $thumbnail_url): InlineQueryResult
    {
        $this->thumbnail_url = $thumbnail_url;
        return $this;
    }


    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->getType(),
            'title' => $this->title,
            'description' => $this->description,
            'reply_markup' => $this->reply_markup?->toArray(),
            'input_message_content' => $this->input_message_content->toArray(),
            'thumbnail_url' => $this->thumbnail_url ?? null,
            'thumbnail_width' => 1,
            'thumbnail_height' => 1,
        ]);
    }

    /**
     * @param InlineReplyMarkup|null $reply_markup
     * @return InlineQueryResult
     */
    public function setReplyMarkup(?InlineReplyMarkup $reply_markup): InlineQueryResult
    {
        $this->reply_markup = $reply_markup;
        return $this;
    }

}
