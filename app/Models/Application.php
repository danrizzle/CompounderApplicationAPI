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

    const APPLICANT_NAME = 'applicant_name';
    const COUNTRY_OF_ORIGIN = 'country_of_origin';
    const PROGRAM_TYPE = 'program_type';
    const APPLICATION_TYPE = 'application_type';
    const SUBMITTED_DOCUMENTS = 'submitted_documents';
}
