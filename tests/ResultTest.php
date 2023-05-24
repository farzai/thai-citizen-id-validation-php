<?php

use Farzai\ThaiIdValidation\Result;

it('can validate thai id', function () {
    $result = new Result('1419900040876');

    expect((string) $result)->toBe('1419900040876');
    expect($result->getId())->toBe('1419900040876');

    expect($result->getType())->toBe('1');
    expect($result->getProvinceOfBirth())->toBe('41');
    expect($result->getDistrictOfBirth())->toBe('99');
    expect($result->getVolume())->toBe('00040');
    expect($result->getNumber())->toBe('87');
    expect($result->getCheckDigit())->toBe('6');
});
