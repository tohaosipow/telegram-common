<?php

namespace Antonosipov\TelegramCommon;

use Illuminate\Http\Request;

class ChosenInlineResult
{
    private string $result_id;
    private From $from;
    private ?string $inline_message_id;
    private string $query;

    /**
     * @param string $result_id
     * @param From $from
     * @param string|null $inline_message_id
     * @param string $query
     */
    public function __construct(string $result_id, From $from, ?string $inline_message_id, string $query)
    {
        $this->result_id = $result_id;
        $this->from = $from;
        $this->inline_message_id = $inline_message_id;
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getResultId(): string
    {
        return $this->result_id;
    }

    /**
     * @return From
     */
    public function getFrom(): From
    {
        return $this->from;
    }

    /**
     * @return string|null
     */
    public function getInlineMessageId(): ?string
    {
        return $this->inline_message_id;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    public static function fromRequest(Request $request): ?ChosenInlineResult
    {
        $chosen_inline_result = $request->chosen_inline_result;
        if (!$chosen_inline_result) {
            return null;
        }
        $from = From::fromArray($chosen_inline_result['from']);
        return new ChosenInlineResult($chosen_inline_result['result_id'], $from, $chosen_inline_result['inline_message_id'] ?? null, $chosen_inline_result['query']);
    }


}
