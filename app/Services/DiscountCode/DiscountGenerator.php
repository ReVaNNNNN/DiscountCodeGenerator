<?php


namespace App\Services\DiscountCode;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DiscountGenerator implements GeneratorInterface
{
    /**
     * @param int $codesNumber
     * @param int $codeLength
     * @param string $fileName
     *
     * @return array
     */
    public function generate(int $codesNumber, int $codeLength, string $fileName = 'result.txt')
    {
        $result = [];

        for ($i = 0; $i < $codesNumber; $i++) {
            $code = $this->createUniqueCode($codeLength);

            if (in_array($code, $result)) {
                $i--; //uwaga na zapętlenie
            } else {
                $result[] = $code . PHP_EOL;
            }
        }

        $this->saveToFile($result, $fileName);
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

    private function saveToFile(array $data, $fileName)
    {
        Storage::disk('local')->put($fileName, $data);
    }
}