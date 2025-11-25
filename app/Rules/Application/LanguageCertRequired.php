<?php

namespace App\Rules\Application;

use App\DTOs\Application\ApplicationDto;
use App\Rules\Interfaces\ApplicationRuleInterface;

class LanguageCertRequired implements ApplicationRuleInterface
{
    public function validate(ApplicationDto $data): array
    {
        if (strtolower($data->applicationType) === 'international') {
            if (!$data->documentExists('language_certificate')) {
                return ['language_certificate'];
            }
        }

        return [];
    }
}
