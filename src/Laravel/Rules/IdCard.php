<?php

declare(strict_types=1);

namespace Farzai\ThaiIdValidation\Laravel\Rules;

use Closure;
use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;
use Farzai\ThaiIdValidation\Validator;
use Illuminate\Foundation\Application;

if (version_compare(Application::VERSION, '10.0.0', '<')) {
    /**
     * @phpstan-ignore-next-line
     */
    class IdCard implements \Illuminate\Contracts\Validation\Rule
    {
        private string $message;

        /**
         * Determine if the validation rule passes.
         */
        public function passes($attribute, $value): bool
        {
            try {
                $validator = new Validator;
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
    class IdCard implements \Illuminate\Contracts\Validation\ValidationRule
    {
        /**
         * Run the validation rule.
         */
        public function validate(string $attribute, mixed $value, Closure $fail): void
        {
            try {
                $validator = new Validator;
                $validator->validate($value);
            } catch (InvalidThaiCitizenIdException $e) {
                $fail($e->getMessage());
            }
        }
    }
}
