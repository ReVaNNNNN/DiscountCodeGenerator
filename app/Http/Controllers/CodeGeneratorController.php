<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountCodeRequest;
use App\Services\DiscountCode\GeneratorInterface;
use App\Services\DiscountCode\ResultInterface;
use Illuminate\View\View;

class CodeGeneratorController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {
        return view('home');
    }

    /**
     * @param DiscountCodeRequest $request
     * @param GeneratorInterface $generator
     * @param ResultInterface $result
     *
     * @return mixed
     */
    public function create(DiscountCodeRequest $request, GeneratorInterface $generator, ResultInterface $result)
    {
        $codesNumber = $request->get('codesNumber');
        $codeLength =  $request->get('codeLength');

        $generator->generate($codesNumber, $codeLength);
        $result->store($generator->getResult());

        return $result->download();
     }
}
