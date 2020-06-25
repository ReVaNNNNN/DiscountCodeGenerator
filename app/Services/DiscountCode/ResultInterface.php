<?php


namespace App\Services\DiscountCode;


interface ResultInterface
{
    /**
     * @param array $data
     * @param string $fileName
     *
     * @return void
     */
    public function store(array $data, ?string $fileName): void;

    /**
     * @param string|null $fileName
     */
    public function download(?string $fileName);
}