<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use function response;

class IndonesiaTeritoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // hanya diambil 100 untuk mempersingkat waktu load DB

        $villages = Village::query()
            ->take(100)
            ->get();

        return response()
            ->json([
                'status' => 'success',
                'data' => $villages,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'unique:indonesia_villages,code'],
            'district_code' => ['required', 'string', 'exists:indonesia_districts,code'],
            'name' => ['required', 'string'],
            'lat' => ['nullable', 'numeric'],
            'long' => ['nullable', 'numeric'],
            'pos' => ['nullable', 'numeric'],
        ]);

        $village = Village::query()
            ->create([
                'code' => $request->code,
                'district_code' => $request->district_code,
                'name' => $request->name,
                'meta' => [
                    'lat' => $request->lat,
                    'long' => $request->long,
                    'pos' => $request->pos,
                ],
            ]);

        return response()
            ->json([
                'status' => 'created',
                'data' => $village,
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $village
     * @return JsonResponse
     */
    public function show($village): JsonResponse
    {
        $village = Village::query()
            ->where('id', $village)
            ->first();

        if (!$village) {
            return response()
                ->json([
                    'status' => 'error',
                    'message' => 'village not found',
                ], 404);
        }

        return response()
            ->json([
                'status' => 'success',
                'data' => $village,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $village
     * @return JsonResponse
     */
    public function update(Request $request, $village): JsonResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'unique:indonesia_villages,code,' . $village . ',id'],
            'district_code' => ['required', 'string', 'exists:indonesia_districts,code'],
            'name' => ['required', 'string'],
            'lat' => ['nullable', 'numeric'],
            'long' => ['nullable', 'numeric'],
            'pos' => ['nullable', 'numeric'],
        ]);

        $village = Village::query()
            ->where('id', $village)
            ->first();

        if (!$village) {
            return response()
                ->json([
                    'status' => 'error',
                    'message' => 'village not found',
                ], 404);
        }

        $village->update([
            'code' => $request->code,
            'district_code' => $request->district_code,
            'name' => $request->name,
            'meta' => [
                'lat' => $request->lat,
                'long' => $request->long,
                'pos' => $request->pos,
            ],
        ]);

        return response()
            ->json([
                'status' => 'success',
                'data' => $village,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $village
     * @return JsonResponse
     */
    public function destroy($village): JsonResponse
    {
        $village = Village::query()
            ->where('id', $village)
            ->first();

        if (!$village) {
            return response()
                ->json([
                    'status' => 'error',
                    'message' => 'village not found',
                ], 404);
        }

        $data = $village;

        $village->delete();

        return response()
            ->json([
                'status' => 'success',
                'data' => $data,
            ]);
    }
}
