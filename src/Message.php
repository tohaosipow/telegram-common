<?php

namespace Antonosipov\TelegramCommon;

use Illuminate\Http\Request;

class Message
{
    private int $message_id;
    private From $from;
    private Chat $chat;
    private int $date;
    private string $text;

    /**
     * @param int $message_id
     * @param From $from
     * @param Chat $chat
     * @param int $date
     * @param string $text
     */
    public function __construct(int $message_id, From $from, Chat $chat, int $date, string $text)
    {
        $this->message_id = $message_id;
        $this->from = $from;
        $this->chat = $chat;
        $this->date = $date;
        $this->text = $text;
    }

    public static function fromRequest(Request $request): ?Message
    {
        $message = $request->message ?? null;
        if (!$message) {
            return null;
        }
        return self::fromArray($message);
    }

    public static function fromArray(array $message): ?Message
    {
        $chat = new Chat(id: $message['chat']['id'], first_name: $message['chat']['first_name'], last_name: $message['chat']['last_name'] ?? '', username: $message['chat']['username'] ?? '', type: $message['chat']['type']);
        $from = From::fromArray($message['from']);
        return new self($message['message_id'], $from, $chat, $message['date'], $message['text'] ?? '');
    }

    /**
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->message_id;
    }

    /**
     * @return From
     */
    public function getFrom(): From
    {
        return $this->from;
    }

    /**
     * @return Chat
     */
    public function getChat(): Chat
    {
        return $this->chat;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

}
