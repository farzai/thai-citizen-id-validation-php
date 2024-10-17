<?php

use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;
use Farzai\ThaiIdValidation\Validator;

it('can validate thai id', function () {
    $this->expectNotToPerformAssertions();

    $validator = new Validator;

    $validator->validate('1410127443236');
});

it('can validate thai id with special character', function () {
    $this->expectNotToPerformAssertions();

    $validator = new Validator;

    $validator->validate('1-4101-27443-23-6');
});

it('can validate via call __invoke()', function () {
    $this->expectNotToPerformAssertions();

    $validator = new Validator;

    $validator('1410127443236');
});

it('should be throw exception when id is not 13 digits', function () {
    $validator = new Validator;

    $validator->validate('123456789012');
})->throws(InvalidThaiCitizenIdException::class);

it('should be throw exception when id is invalid', function () {
    $validator = new Validator;

    $validator->validate('1410127443237');
})->throws(InvalidThaiCitizenIdException::class);
