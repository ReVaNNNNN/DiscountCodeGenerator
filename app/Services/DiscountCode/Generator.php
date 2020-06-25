<?php


namespace App\Services\DiscountCode;

use Illuminate\Support\Str;

class Generator implements GeneratorInterface
{
    /**
     * @var array
     */
    private $result = [];

    /**
     * @param int $codesNumber
     * @param int $codeLength
     *
     * @return void
     */
    public function generate(int $codesNumber, int $codeLength): void
    {
        for ($i = 0; $i < $codesNumber; $i++) {
            $code = $this->createUniqueCode($codeLength);

            $this->storeCode($code, $i);
        }
    }

    /**
     * @return array
     */
    public function getResult(): array
    {
        return $this->result;
    }

    /**
     * @param int $codeLength
     *
     * @return string
     */
    private function createUniqueCode(int $codeLength): string
    {
        return Str::random($codeLength);
    }

    /**
     * @param string $code
     * @param int $i
     *
     * @return void
     */
    private function storeCode(string $code, int &$i): void
    {
        // 4 znakowe kody wykorzystujące duże i małe litery oraz cyfry pozwalają stworzyć ponad 14 000 000 unikalnych kombinacji
        // zakładam że kod musi mieć minimum 4 znaki oraz, że nie chcemy jednorazowo generować więcej niż 14 000 000 kodów,
        // w innym wypadku należałoby stworzyć inną implementację algorytmu, ponieważ może dojść do 'nieskończonej pętli'
        if (in_array($code, $this->result)) {
            $i--;
        } else {
            $this->result[] = $this->formatCode($code);
        }
    }

    /**
     * @param string $code
     *
     * @return string
     */
    private function formatCode(string $code): string
    {
        return $code . PHP_EOL;
    }
}