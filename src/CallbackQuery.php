<?php

namespace Antonosipov\TelegramCommon;

use Illuminate\Http\Request;

class CallbackQuery
{
    private int $id;
    private From $from;
    private Message $message;
    private ?object $data;

    /**
     * @param int $id
     * @param From $from
     * @param Message $message
     * @param object|null $data
     */
    public function __construct(int $id, From $from, Message $message, ?object $data)
    {
        $this->id = $id;
        $this->from = $from;
        $this->message = $message;
        $this->data = $data;
    }

    public static function fromRequest(Request $request): ?self
    {
        $callback_query = $request->callback_query;
        if (!$callback_query) {
            return null;
        }
        $from = From::fromArray($callback_query['from']);
        $message = Message::fromArray($callback_query['message']);
        $data = json_decode($callback_query['data']);
        return new self($callback_query['id'], $from, $message, $data);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return From
     */
    public function getFrom(): From
    {
        return $this->from;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @return object|null
     */
    public function getData(): ?object
    {
        return $this->data;
    }


}
