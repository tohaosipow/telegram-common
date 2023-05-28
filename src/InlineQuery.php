<?php

namespace Antonosipov\TelegramCommon;

use Illuminate\Http\Request;

class InlineQuery
{
    private int $id;
    private From $from;
    private string $chat_type;
    private string $query;
    private ?string $offset;

    /**
     * @param int $id
     * @param From $from
     * @param string $chat_type
     * @param string $query
     * @param string $offset
     */
    public function __construct(int $id, From $from, string $chat_type, string $query, ?string $offset)
    {
        $this->id = $id;
        $this->from = $from;
        $this->chat_type = $chat_type;
        $this->query = $query;
        $this->offset = $offset;
    }

    public static function fromRequest(Request $request): ?InlineQuery
    {
        $inline_query = $request->inline_query;
        if(!$inline_query){
            return null;
        }
        $from = From::fromArray($inline_query['from']);
        return new self(id: $inline_query['id'], from: $from, chat_type: $inline_query['chat_type'], query: $inline_query['query'] ?? '', offset: $inline_query['offset']);
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
     * @return string
     */
    public function getChatType(): string
    {
        return $this->chat_type;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string|null
     */
    public function getOffset(): ?string
    {
        return $this->offset;
    }



}
