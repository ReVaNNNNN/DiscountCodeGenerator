<?php


namespace App\Services\DiscountCode;

use Illuminate\Support\Facades\Storage;

class FileHandler implements ResultInterface
{
    /**
     * @param array $data
     * @param string|null $fileName
     *
     * @return void
     */
    public function store(array $data, ?string $fileName = 'result.txt'): void
    {
        Storage::disk('local')->put($fileName, $data);
    }

    /**
     * @param string|null $fileName
     *
     * @return mixed
     */
    public function download(?string $fileName = 'result.txt')
    {
        return Storage::download($fileName);
    }
}