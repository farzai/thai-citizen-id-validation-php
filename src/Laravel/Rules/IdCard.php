<?php

namespace Farzai\ThaiIdValidation\Laravel\Rules;

use Closure;
use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;
use Farzai\ThaiIdValidation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class IdCard implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $validator = new Validator();
            $validator->validate($value);
        } catch (InvalidThaiCitizenIdException $e) {
            $fail($e->getMessage());
        }
    }
}
