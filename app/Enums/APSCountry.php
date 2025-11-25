<?php

namespace App\Enums;

enum APSCountry: string
{
    public const CHINA = 'china';
    public const VIETNAM = 'vietnam';
    public const INDIA = 'india';
    public const MONGOLIA = 'mongolia';

    /**
     * @return array<string>
     */
    public static function allCountries(): array
    {
        return [
            self::CHINA,
            self::VIETNAM,
            self::INDIA,
            self::MONGOLIA,
        ];
    }
}
