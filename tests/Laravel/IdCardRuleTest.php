<?php

use Farzai\ThaiIdValidation\Laravel\Rules\IdCard;
use Illuminate\Support\Facades\Validator;

it('passes when given a valid id card number', function () {
    $validator = Validator::make(
        ['id_card' => '1410127443236'],
        ['id_card' => new IdCard]
    );

    expect($validator->passes())->toBeTrue();
});

it('should throw exception when given an invalid id card number', function () {
    $validator = Validator::make(
        ['id_card' => '111'],
        ['id_card' => new IdCard]
    );

    $validator->validate();
})->throws('The id must be 13 digits.');

it('should match implementation when using Laravel 8', function () {
    if (version_compare(app()->version(), '8.0.0', '<')) {
        $this->markTestSkipped('This test only run on Laravel 8 or above.');
    }

    $validator = Validator::make(
        ['id_card' => '1410127443236'],
        ['id_card' => new IdCard]
    );

    expect($validator->passes())->toBeTrue();
});

it('should match implementation when using Laravel 10', function () {
    if (version_compare(app()->version(), '8.0.0', '>=')) {
        $this->markTestSkipped('This test only run on Laravel 10 or below.');
    }

    $validator = Validator::make(
        ['id_card' => '1410127443236'],
        ['id_card' => new IdCard]
    );

    expect($validator->passes())->toBeTrue();
});
