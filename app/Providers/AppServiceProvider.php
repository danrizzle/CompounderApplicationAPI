<?php

namespace App\Providers;

use App\Actions\Application\ValidateDocumentsAction;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ValidateDocumentsAction::class, function () {
            $documentValidationRulesCollection = collect(File::allFiles(app_path('Rules/Application')))
                ->map(function ($file) {
                    return 'App\\Rules\\Application\\' . $file->getBasename('.php');
                })
                ->toArray();

            $documentValidationRules = array_map(function ($ruleClass) {
                $rule = new $ruleClass();

                if ($rule instanceof \App\Rules\Interfaces\ApplicationRuleInterface) {
                    return $rule;
                }
            }, $documentValidationRulesCollection);

            return new ValidateDocumentsAction($documentValidationRules);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
