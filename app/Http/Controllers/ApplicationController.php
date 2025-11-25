<?php

namespace App\Http\Controllers;

use App\DTOs\Application\ApplicationDto;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Resources\ApplicationValidationResource;
use App\Services\Application\ApplicationValidationService;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * @param  \App\Services\Application\ApplicationValidationService  $applicationValidationService
     */
    public function __construct(
        private ApplicationValidationService $applicationValidationService
    ) {}

    /**
     * @param  \App\Http\Requests\StoreApplicationRequest  $request
     * 
     * @return \App\Http\Resources\ApplicationValidationResource
     */
    public function store(StoreApplicationRequest $request): ApplicationValidationResource
    {
        $applicationDto = ApplicationDto::fromArray($request->validated());

        $validationResult = $this->applicationValidationService->validate($applicationDto);

        return new ApplicationValidationResource($validationResult);
    }
}
