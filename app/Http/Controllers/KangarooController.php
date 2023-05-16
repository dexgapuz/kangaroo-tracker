<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\KangarooRequest;
use App\Models\Kangaroo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KangarooController extends Controller
{
    public function index(): JsonResponse
    {
        $kangaroos = Kangaroo::latest()->get();

        return response()->json($kangaroos);
    }

    public function store(KangarooRequest $request): JsonResponse
    {
        $data = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'weight' => $request->weight,
            'height' => $request->height,
            'gender' => $request->gender,
            'color' => $request->color,
            'friendliness' => $request->friendliness,
            'birthday' => $request->birthday
        ];

        Kangaroo::create($data);

        return response()->json();
    }

    public function update(KangarooRequest $request, Kangaroo $kangaroo): JsonResponse
    {
        $data = [
            'name' => $request->name,
            'nickname' => $request->nickname,
            'weight' => $request->weight,
            'height' => $request->height,
            'gender' => $request->gender,
            'color' => $request->color,
            'friendliness' => $request->friendliness,
            'birthday' => $request->birthday
        ];

        $kangaroo->update($data);

        return response()->json();
    }

    public function destroy(Kangaroo $kangaroo): JsonResponse
    {
        $kangaroo->delete();

        return response()->json();
    }
}
