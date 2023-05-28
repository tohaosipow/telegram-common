<?php

namespace Antonosipov\TelegramCommon\Keyboard;

use Illuminate\Contracts\Support\Arrayable;

class InlineReplyMarkup
{

    private array $buttons;

    /**
     * @param array $buttons
     */
    public function __construct(array $buttons = [])
    {
        $this->buttons = $buttons;
    }

    public function addRow(array $row): static
    {
        $this->buttons[] = $row;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'inline_keyboard' =>
                array_values(
                    array_filter(array_map(fn(array $row) =>
                    array_values(array_map(fn($button) => $button->toArray(), $row)), $this->buttons)))];
    }

}
