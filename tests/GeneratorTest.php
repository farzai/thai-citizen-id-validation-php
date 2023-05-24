<?php

use Farzai\ThaiIdValidation\Generator;

it('can generate thai id', function () {
    $generator = new Generator();

    $id = $generator->generate();

    expect(strlen($id))->toBe(13);
});

it('can generate with __invoke()', function () {
    $generate = new Generator();

    $id = $generate();

    expect(strlen($id))->toBe(13);
});

it('can generate thai id with person type', function () {
    $generator = new Generator();

    $id = (string) $generator->personType('2')->generate();

    expect($id[0])->toBe('2');
});

it('can generate thai id with province of birth', function () {
    $generator = new Generator();

    $id = (string) $generator->provinceOfBirth('10')->generate();

    expect($id[1].$id[2])->toBe('10');
});

it('can generate thai id with district of birth', function () {
    $generator = new Generator();

    $id = (string) $generator->districtOfBirth('10')->generate();

    expect($id[3].$id[4])->toBe('10');
});

it('should throw exception when person type is greater than 8', function () {
    $generator = new Generator();

    $generator->personType(9)->generate();
})->throws(InvalidArgumentException::class);

it('should throw exception when province of birth is not 2 digits', function () {
    $generator = new Generator();

    $generator->provinceOfBirth('100')->generate();
})->throws(InvalidArgumentException::class);

it('should throw exception when district of birth is not 2 digits', function () {
    $generator = new Generator();

    $generator->districtOfBirth('100')->generate();
})->throws(InvalidArgumentException::class);
