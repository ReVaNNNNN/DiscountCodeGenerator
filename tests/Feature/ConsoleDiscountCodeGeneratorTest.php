<?php

namespace Tests\Feature;

use App\Services\DiscountCode\FileHandler;
use Tests\TestCase;

/**
 * @property string fileName
 */
class ConsoleDiscountCodeGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->fileName = 'result.txt';
    }

    public function test_console_command_is_correct_for_valid_arguments()
    {
        $this->artisan('generate-discount-codes')
            ->expectsQuestion('Enter the number of codes (min. 1)', 5)
            ->expectsQuestion('Enter the length of the code (min. 4)', 10)
            ->expectsQuestion('Enter file name (optional)', $this->fileName)
            ->expectsOutput(PHP_EOL . 'Codes stored in storage\app\\' . $this->fileName)
            ->assertExitCode(0);
    }

    public function test_console_command_is_incorrect_for_wrong_codes_number()
    {
        $this->artisan('generate-discount-codes')
            ->expectsQuestion('Enter the number of codes (min. 1)', 0)
            ->expectsQuestion('Enter the length of the code (min. 4)', 5)
            ->expectsQuestion('Enter file name (optional)', $this->fileName)
            ->expectsOutput('Codes not created. See error messages below:')
            ->expectsOutput('The codes number must be at least 1.');
    }

    public function test_console_command_is_incorrect_for_wrong_codes_length()
    {
        $this->artisan('generate-discount-codes')
            ->expectsQuestion('Enter the number of codes (min. 1)', 5)
            ->expectsQuestion('Enter the length of the code (min. 4)', 3)
            ->expectsQuestion('Enter file name (optional)', $this->fileName)
            ->expectsOutput('Codes not created. See error messages below:')
            ->expectsOutput('The code length must be at least 4.');
    }

    public function test_console_command_is_incorrect_for_wrong_file_name_extension()
    {
        $incorrectFilename = 'result.csv';

        $this->artisan('generate-discount-codes')
            ->expectsQuestion('Enter the number of codes (min. 1)', 5)
            ->expectsQuestion('Enter the length of the code (min. 4)', 5)
            ->expectsQuestion('Enter file name (optional)', $incorrectFilename)
            ->expectsOutput( sprintf('Filename should have %s extension !', FileHandler::TEXT_FILE_EXTENSION ))
            ->expectsOutput('Codes not created. See error messages below:');
    }
}
