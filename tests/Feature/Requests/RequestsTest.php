<?php

use Illuminate\Support\Facades\File;

test('all requests implement rules() and bodyParams() methods', function () {

    $requestFiles = File::glob(app_path('Http/Requests/*.php'));

    $requestClasses = collect($requestFiles)->map(function ($file) {
        $className = 'App\\Http\\Requests\\'.str_replace('.php', '', basename($file));

        return [$className];
    })->toArray();

    foreach ($requestClasses as $requestClass) {

        // $requestClass = new ReflectionClass($request[0]);
        // expect($requestClass->hasMethod('rules'))->toBeTrue();
        // expect($requestClass->hasMethod('bodyParameters'))->toBeTrue();

        $request = new $requestClass[0];
        expect($request)
            ->toBeInstanceOf(Illuminate\Foundation\Http\FormRequest::class);

        expect($request->rules())->toBeArray();
        expect($request->bodyParameters())->toBeArray();

    }
});
