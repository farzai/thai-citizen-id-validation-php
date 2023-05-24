<?php

namespace Farzai\ThaiIdValidation;

class Result
{
    /**
     * The id number to validate
     */
    private string $id;

    /**
     * Create a new instance
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * The id number
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * The type of person
     * (1 digit)
     */
    public function getType(): string
    {
        return substr($this->id, 0, 1);
    }

    /**
     * Province of birth
     * (2 digits)
     */
    public function getProvinceOfBirth(): string
    {
        return substr($this->id, 1, 2);
    }

    /**
     * District of birth
     * (2 digits)
     */
    public function getDistrictOfBirth(): string
    {
        return substr($this->id, 3, 2);
    }

    /**
     * Indicate the volume of the birth certificate. By type of person
     * (5 digits)
     */
    public function getVolume(): string
    {
        return substr($this->id, 5, 5);
    }

    /**
     * The number of each birth certificate. By type of person
     * (4 digits)
     */
    public function getNumber(): string
    {
        return substr($this->id, 10, 2);
    }

    /**
     * The number to verify the correctness of all national id numbers.
     * (1 digit)
     */
    public function getCheckDigit(): string
    {
        return substr($this->id, 12, 1);
    }

    public function __toString()
    {
        return $this->id;
    }
}
