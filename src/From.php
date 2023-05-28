<?php

namespace Antonosipov\TelegramCommon;

class From
{
    private int $id;
    private bool $is_bot;
    private string $first_name;
    private ?string $last_name;
    private string $language_code;
    private string $username;

    /**
     * @param int $id
     * @param bool $is_bot
     * @param string $first_name
     * @param ?string $last_name
     * @param string $language_code
     * @param string $username
     */
    public function __construct(int $id, bool $is_bot, string $first_name, ?string $last_name, string $language_code, ?string $username)
    {
        $this->id = $id;
        $this->is_bot = $is_bot;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->language_code = $language_code;
        $this->username = $username;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isIsBot(): bool
    {
        return $this->is_bot;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->language_code;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    public static function fromArray(array $array): From
    {
        return new self(id: $array['id'], is_bot: $array['is_bot'], first_name: $array['first_name'], last_name: $array['last_name'] ?? '', language_code: $array['language_code'] ?? 'ru', username: $array['username'] ?? '');
    }


}
