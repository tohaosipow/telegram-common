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

  public static function extractCommandAndParamsFromMessage(string $text): ?self
  {
    $matches = [];
    if (!preg_match('/\/[\w_]+(\s[0-9a-zA-Z_]*){0,10}/', $text)) {
      return null;
    }
    preg_match_all('/\s([0-9a-zA-Z_]*)/', $text, $matches);
    $commands = [];
    preg_match_all('/\/([\w_]+)/', $text, $commands);
    return new self($commands[1][0], $matches[1]);
  }


}
