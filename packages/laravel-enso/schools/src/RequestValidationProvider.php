<?php

namespace LaravelEnso\Schools;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Schools\app\Contracts\ValidatesSchoolRequest;
use LaravelEnso\Schools\app\Http\Requests\ValidateSchoolRequest;

class RequestValidationProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            ValidatesSchoolRequest::class, ValidateSchoolRequest::class
        );
    }
}
