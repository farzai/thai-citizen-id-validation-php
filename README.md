# Thai Citizen ID Validator PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/farzai/thai-citizen-id-validation.svg?style=flat-square)](https://packagist.org/packages/farzai/thai-citizen-id-validation)
[![Tests](https://img.shields.io/github/actions/workflow/status/farzai/thai-citizen-id-validation-php/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/farzai/thai-citizen-id-validation-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/farzai/thai-citizen-id-validation.svg?style=flat-square)](https://packagist.org/packages/farzai/thai-citizen-id-validation)


Thai Citizen ID validator is a easy-to-use PHP library designed to help validate Thai National Identification Card numbers

## Installation

You can install the package via composer:

```bash
composer require farzai/thai-citizen-id-validation
```

## Usage for validation
Example usage for validating Thai Citizen ID
```php
use Farzai\ThaiIdValidation\Validator;
use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;

$validator = new Validator('1410100100000');

try {
    $validator->validate();
} catch (InvalidThaiCitizenIdException $e) {
    // Handle invalid citizen id
}
```

## Usage for generating
Sometimes you need to generate a random Thai Citizen ID for testing purpose. This library can help you with that.

```php
use Farzai\ThaiIdValidation\Generator;

$generator = new Generator();

// Optional
$generator
    ->personType(1) // ประเภทบุคคล
    ->provinceOfBirth('10') // เลขจังหวัดที่เกิด
    ->districtOfBirth('10'); // เลขอำเภอที่เกิด

// Generate
$idCard = $generator->generate();

echo (string)$idCard; // 1410100100000

echo $idCard->getId(); // 1410100100000
echo $idCard->getType(); // 1 digit
echo $idCard->getProvinceOfBirth(); // 2 digit
echo $idCard->getDistrictOfBirth(); // 2 digit
echo $idCard->getVolume(); // 5 digit
echo $idCard->getNumber(); // 4 digit
echo $idCard->getCheckDigit(); // 1 digit
```

## Usage with Laravel
You can use the `IdCard` rule to validate Thai Citizen ID in Laravel.
```php
use Farzai\ThaiIdValidation\Laravel\Rules\IdCard;

$request->validate([
    'id_card' => ['required', new IdCard],
]);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [parsilver](https://github.com/parsilver)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
