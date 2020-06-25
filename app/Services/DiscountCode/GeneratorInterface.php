<?php


namespace App\Services\DiscountCode;


interface GeneratorInterface
{
    /**
     * @param int $codesNumber
     * @param int $codeLength
     *
     * @return void
     */
    public function generate(int $codesNumber, int $codeLength): void;

    /**
     * @return array
     */
    public function getResult(): array;
}