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

## Usage

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
