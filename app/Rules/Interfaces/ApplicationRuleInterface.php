<?php

namespace App\Rules\Interfaces;

use App\DTOs\Application\ApplicationDto;

interface ApplicationRuleInterface
{
    /**
     * @param  \App\DTOs\Application\ApplicationDto  $data
     * 
     * @return array<string>
     */
    public function validate(ApplicationDto $data): array;
}
