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

it('should match implementation when using Laravel', function () {
    $validator = Validator::make(
        ['id_card' => '1410127443236'],
        ['id_card' => $rule = new IdCard]
    );

    if (version_compare(app()->version(), '10.0.0', '<')) {
        expect($rule)->toBeInstanceOf(Illuminate\Contracts\Validation\Rule::class);
        expect($rule->message())->toBeString();
    } else {
        expect($rule)->toBeInstanceOf(Illuminate\Contracts\Validation\ValidationRule::class);
        $rule->validate('id_card', '1410127443236', function ($message) {
            expect($message)->toBeString();
        });
    }

    expect($validator->passes())->toBeTrue();
});
