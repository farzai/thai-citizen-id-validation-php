<?php

namespace Farzai\ThaiIdValidation;

use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;

class Validator
{
    /**
     * Validate the thai national id
     *
     * @throws InvalidThaiCitizenIdException
     */
    public function __invoke(string $id): void
    {
        $this->validate($id);
    }

    /**
     * Validate the thai national id
     *
     * @throws InvalidThaiCitizenIdException
     */
    public function validate(string $id): void
    {
        $id = $this->normalizeTarget($id);

        // Check if the id length is exactly 13
        if (strlen($id) !== 13) {
            throw new InvalidThaiCitizenIdException('The id must be 13 digits.');
        }

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

    /**
     * Normalize the target
     */
    protected function normalizeTarget(string $target): string
    {
        // Remove all non-digit characters
        $target = preg_replace('/[^0-9]/', '', $target);

        return $target;
    }
}
