<?php

namespace Antonosipov\TelegramCommon;

class Command
{
    private string $command;
    private array $params;

    /**
     * @param string $command
     * @param array $params
     */
    public function __construct(string $command, array $params)
    {
        $this->command = $command;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }



}
