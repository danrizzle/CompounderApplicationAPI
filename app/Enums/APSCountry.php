<?php

namespace App\Enums;

enum APSCountry: string
{
    const CHINA = 'china';
    const VIETNAM = 'vietnam';
    const INDIA = 'india';
    const MONGOLIA = 'mongolia';

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
