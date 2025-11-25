<?php

namespace App\Rules\Application;

use App\DTOs\Application\ApplicationDto;
use App\Rules\Interfaces\ApplicationRuleInterface;

class BachelorDegreeRequired implements ApplicationRuleInterface
{
    public function validate(ApplicationDto $data): array
    {
        if (strtolower($data->programType) === 'master') {
            if (!$data->documentExists('bachelor_diploma')) {
                return ['bachelor_diploma'];
            }
        }

        return [];
    }
}
