<?php

namespace Farzai\ThaiIdValidation\Contracts;

use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;

interface Validator
{
    /**
     * Validate the thai national id
     *
     * @throws InvalidThaiCitizenIdException
     */
    public function validate(string $id): void;
}
