<?php

namespace Tests\Feature;

use Tests\TestCase;

class HttpDiscountCodeGeneratorTest extends TestCase
{
    public function test_expect_download_result_file_for_valid_arguments()
    {
        $response = $this->post('/', [
            'codesNumber' => 5,
            'codeLength' => 5,
        ]);

        $response->assertHeader('Content-Disposition', 'attachment; filename=result.txt');
    }

    public function test_expect_error_for_wrong_codes_number()
    {
        $response = $this->post('/', [
            'codesNumber' => 0,
            'codeLength' => 5,
        ]);

        $response->assertHeaderMissing('Content-Disposition');
        $response->assertSessionHasErrors('codesNumber');
    }

    public function test_expect_error_for_wrong_codes_length()
    {
        $response = $this->post('/', [
            'codesNumber' => 5,
            'codeLength' => 3,
        ]);

        $response->assertHeaderMissing('Content-Disposition');
        $response->assertSessionHasErrors('codeLength');
    }
}
