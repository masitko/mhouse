<?php

namespace LaravelEnso\Schools;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Schools\app\Contracts\ValidatesCompanyRequest;
use LaravelEnso\Schools\app\Http\Requests\ValidateCompanyRequest;

class RequestValidationProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            ValidatesCompanyRequest::class, ValidateCompanyRequest::class
        );
    }
}
