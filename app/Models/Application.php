<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        self::APPLICANT_NAME,
        self::COUNTRY_OF_ORIGIN,
        self::PROGRAM_TYPE,
        self::APPLICATION_TYPE,
        self::SUBMITTED_DOCUMENTS,
    ];

    protected $casts = [
        self::SUBMITTED_DOCUMENTS => 'array',
    ];

    public const APPLICANT_NAME = 'applicant_name';
    public const COUNTRY_OF_ORIGIN = 'country_of_origin';
    public const PROGRAM_TYPE = 'program_type';
    public const APPLICATION_TYPE = 'application_type';
    public const SUBMITTED_DOCUMENTS = 'submitted_documents';
}
