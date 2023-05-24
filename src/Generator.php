<?php

namespace Farzai\ThaiIdValidation;

class Generator
{
    private $personType = '1';

    private $provinceOfBirth = '41';

    private $districtOfBirth = '01';

    /**
     * Create a new instance
     */
    public function __construct()
    {
        //
    }

    /**
     * Set the person type
     *
     * @param  int|string  $personType
     */
    public function personType($personType): self
    {
        if ((int) $personType < 1 || (int) $personType > 8) {
            throw new \InvalidArgumentException('The person type must be between 1 and 8.');
        }

        $this->personType = (string) $personType;

        return $this;
    }

    /**
     * Set the province of birth
     */
    public function provinceOfBirth(string $provinceOfBirth): self
    {
        if (strlen($provinceOfBirth) !== 2) {
            throw new \InvalidArgumentException('The province of birth must be 2 digits.');
        }

        $this->provinceOfBirth = $provinceOfBirth;

        return $this;
    }

    /**
     * Set the district of birth
     */
    public function districtOfBirth(string $districtOfBirth): self
    {
        if (strlen($districtOfBirth) !== 2) {
            throw new \InvalidArgumentException('The district of birth must be 2 digits.');
        }

        $this->districtOfBirth = $districtOfBirth;

        return $this;
    }

    /**
     * Generate a random Thai national id (13 digits)
     */
    public function generate(): Result
    {
        $id = $this->personType
            .$this->provinceOfBirth
            .$this->districtOfBirth;

        for ($i = 0; $i < 7; $i++) {
            $id .= mt_rand(0, 9);
        }

        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (int) $id[$i] * (13 - $i);
        }

        $checkDigit = (11 - ($sum % 11)) % 10;
        $id .= $checkDigit;

        return new Result($id);
    }

    public function __invoke(): Result
    {
        return $this->generate();
    }
}
