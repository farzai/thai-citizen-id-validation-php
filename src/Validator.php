<?php

namespace Farzai\ThaiIdValidation;

use Farzai\ThaiIdValidation\Exceptions\InvalidThaiCitizenIdException;

class Validator
{
    /**
     * The last solution that was used to validate
     */
    public ?string $lastSolution = null;

    /**
     * The solutions to validate the thai national id
     *
     * @var array
     */
    private $solutions = [
        Algorithms\SimpleWithMod11::class,
    ];

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

        foreach ($this->solutions as $solution) {
            $error = $this->validateUsing(new $solution, $id);

            if ($error === null) {
                $this->foundSolution($solution);

                return;
            }
        }

        throw $error ?? new InvalidThaiCitizenIdException('The id is invalid.');
    }

    /**
     * Normalize the target
     */
    private function normalizeTarget(string $target): string
    {
        // Remove all non-digit characters
        $target = preg_replace('/[^0-9]/', '', $target);

        return $target;
    }

    /**
     * Validate the thai national id using the given solution
     */
    private function validateUsing(Contracts\Validator $solution, string $id): ?InvalidThaiCitizenIdException
    {
        try {
            $solution->validate($id);
        } catch (InvalidThaiCitizenIdException $e) {
            return $e;
        }

        return null;
    }

    private function foundSolution(string $solution): void
    {
        $this->lastSolution = $solution;
    }
}
