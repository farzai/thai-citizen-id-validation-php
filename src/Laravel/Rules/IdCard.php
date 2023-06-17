<?php

namespace Farzai\ThaiIdValidation\Laravel\Rules;

use Closure;
use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;
use Farzai\ThaiIdValidation\Validator;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Application;

if (version_compare(Application::VERSION, '8.0.0', '>=')) {
    /**
     * @see https://laravel.com/docs/8.x/validation#using-rule-objects
     *
     * @phpstan-ignore-next-line
     */
    class IdCard implements Rule
    {
        private string $message;

        /**
         * Determine if the validation rule passes.
         */
        public function passes($attribute, $value): bool
        {
            try {
                $validator = new Validator();
                $validator->validate($value);
            } catch (InvalidThaiCitizenIdException $e) {
                $this->message = $e->getMessage();

                return false;
            }

            return true;
        }

        /**
         * Get the validation error message.
         */
        public function message(): string
        {
            return $this->message;
        }
    }
} else {
    /**
     * @see https://laravel.com/docs/10.x/validation#using-rule-objects
     */
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

        /**
         * Determine if the validation rule passes.
         */
        public function passes($attribute, $value): bool
        {
            try {
                $validator = new Validator();
                $validator->validate($value);
            } catch (InvalidThaiCitizenIdException $e) {
                return false;
            }

            return true;
        }
    }
}
