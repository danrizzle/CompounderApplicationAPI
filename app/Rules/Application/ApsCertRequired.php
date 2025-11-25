<?php

namespace App\Rules\Application;

use App\Enums\APSCountry;
use App\DTOs\Application\ApplicationDto;
use App\Rules\Interfaces\ApplicationRuleInterface;

class ApsCertRequired implements ApplicationRuleInterface
{
    public function validate(ApplicationDto $data): array
    {
        if (in_array(strtolower($data->countryOfOrigin), APSCountry::allCountries())) {
            if (!$data->documentExists('aps_certificate')) {
                return ['aps_certificate'];
            }
        }

        return [];
    }
}
