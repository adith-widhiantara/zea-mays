<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use function implode;
use function response;

class FizzBuzzController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ulartangga(Request $request): JsonResponse
    {
        $int = 100;

        if ($request->filled('int')) {
            $int = $request->int;
        }

        $fizzbuzz = [];
        for ($i = 1; $i <= $int; $i++) {
            if ($i % 15 === 0) {
                $fizzbuzz[] = 'ulartangga';
            } else if ($i % 3 === 0) {
                $fizzbuzz[] = 'ular';
            } else if ($i % 5 === 0) {
                $fizzbuzz[] = 'tangga';
            } else {
                $fizzbuzz[] = $i;
            }
        }

        $fizzbuzz = implode(' ', $fizzbuzz);

        return response()
            ->json($fizzbuzz);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function printNumber(Request $request): JsonResponse
    {
        $input = 14;

        if ($request->filled('int')) {
            $input = $request->int;
        }

        $final = '';
        for ($i = 1; $i <= $input; $i += 5) {
            for ($j = 0; $j <= 4; $j++) {
                if ($i + $j <= $input) {
                    if ($j == 1 || $j == 4) {
                        $final .= '* ';
                    } else {
                        $final .= ($i + $j) . ' ';
                    }
                }
            }
        }

        return response()
            ->json($final);
    }
}
