<?php

namespace App\Console\Commands;

use App\Services\DiscountCode\FileHandler;
use App\Services\DiscountCode\GeneratorInterface;
use App\Services\DiscountCode\ResultInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class GenerateDiscountCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-discount-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and store discount codes in given filename';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param GeneratorInterface $generator
     * @param ResultInterface $result
     *
     * @return void
     */
    public function handle(GeneratorInterface $generator, ResultInterface $result): void
    {
        [$codesNumber, $codeLength, $fileName] = $this->getCommandArguments();

        if (!$this->isValid($codesNumber, $codeLength, $fileName)) {
            return;
        }

        $generator->generate($codesNumber, $codeLength);
        $result->store($generator->getResult(), $fileName);

        $this->printOutput($fileName);
    }

    /**
     * @param $codesNumber
     * @param $codeLength
     * @param $fileName
     *
     * @return bool
     */
    private function isValid($codesNumber, $codeLength, $fileName): bool
    {
        $validator = Validator::make([
            'codesNumber'  => $codesNumber,
            'codeLength' => $codeLength,
        ], [
            'codesNumber' => ['required', 'int', 'min:1'],
            'codeLength' => ['required', 'int', 'min:4'],
        ]);

        if ($validator->fails() || $this->isFileNameInvalid($fileName)) {
            $this->error('Codes not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    private function getCommandArguments(): array
    {
        $codesNumber = $this->ask('Enter the number of codes (min. 1)');
        $codeLength = $this->ask('Enter the length of the code (min. 4)');
        $fileName = $this->ask('Enter file name (optional)', 'result.txt');

        return [$codesNumber, $codeLength, $fileName];
    }

    /**
     * @param string $fileName
     *
     * @return bool
     */
    private function isFileNameInvalid(string $fileName): bool
    {
       if(!$this->isTextFile($fileName)) {
            $this->error(
                sprintf('Filename should have %s extension !', FileHandler::TEXT_FILE_EXTENSION )
            );

            return true;
       }

        return false;
    }

    /**
     * @param string $fileName
     *
     * @return bool
     */
    private function isTextFile(string $fileName): bool
    {
        return substr($fileName, -4, 4) === FileHandler::TEXT_FILE_EXTENSION;
    }

    /**
     * @param string $fileName
     */
    private function printOutput(string $fileName): void
    {
        $this->info(
            sprintf('%sCodes stored in storage\app\\%s', PHP_EOL, $fileName)
        );
    }
}
