<?php

namespace App\Actions\Application;

use App\DTOs\Application\ApplicationDto;

class ValidateDocumentsAction
{
    /**
     * @var array<\App\Rules\Interfaces\ApplicationRuleInterface> $rules
     */
    private array $rules;

    /**
     * @param array<\App\Rules\Interfaces\ApplicationRuleInterface> $rules
     */
    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }

    /**
     * @param  \App\DTOs\Application\ApplicationDto  $data
     * 
     * @return array<string>
     */
    public function execute(ApplicationDto $data): array
    {
        $missingDocuments = [];

        foreach ($this->rules as $rule) {
            $result = $rule->validate($data);

            if (!empty($result)) {
                foreach ($result as $doc) {
                    $missingDocuments[] = $doc;
                }
            }
        }

        return array_unique($missingDocuments);
    }
}
