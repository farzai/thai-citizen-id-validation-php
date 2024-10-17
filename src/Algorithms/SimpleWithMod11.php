<?php

namespace Farzai\ThaiIdValidation\Algorithms;

use Farzai\ThaiIdValidation\Contracts\Validator;
use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;

class SimpleWithMod11 implements Validator
{
    /**
     * Validate the thai national id
     *
     * @throws InvalidThaiCitizenIdException
     */
    public function validate(string $id): void
    {
        // Calculate the sum of each digit multiplied by the weight
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (int) $id[$i] * (13 - $i);
        }

        // Calculate the check digit
        $checkDigit = (11 - ($sum % 11)) % 10;

        // Compare the last digit with the check digit
        if ((int) $id[12] !== $checkDigit) {
            throw new InvalidThaiCitizenIdException('The id is invalid.');
        }
    }
}
