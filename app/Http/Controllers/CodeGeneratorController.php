<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountCodeRequest;
use App\Services\DiscountCode\DiscountGenerator;
use Illuminate\Support\Facades\Storage;
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

    public function create(DiscountCodeRequest $request)
    {
        // 1 Walidacja Requesta
        // 2 Zabezpieczenie przed nieskończoną pętla
        // 3 Wywołanie generatora poprzez konsolę
        // 4 Refaktoryzcja kodu
        // 5 Dokumentacja metod + Readme jak obsłużyć konsolę
        // 6 Testy jednostkowe ?

        $codesNumber = $request->get('codesNumber');
        $codeLength =  $request->get('codeLength');

        $gen = new DiscountGenerator();
        $gen->generate($codesNumber, $codeLength);

        return Storage::download('result.txt');
    }
}
