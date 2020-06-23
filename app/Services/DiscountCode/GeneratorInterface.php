<?php


namespace App\Services\DiscountCode;


interface GeneratorInterface
{
    /**
     * @param int $codesNumber
     * @param int $codeLength
     * @param string $fileName
     *
     */
    public function generate(int $codesNumber, int $codeLength, string $fileName = 'result.txt');
}