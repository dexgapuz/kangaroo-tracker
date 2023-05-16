<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Kangaroo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KangarooController extends Controller
{
    public function index(): JsonResponse
    {
        $kangaroos = Kangaroo::all();

        return response()->json($kangaroos);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Kangaroo $kangaroo)
    {
        //
    }

    public function destroy(Kangaroo $kangaroo)
    {
        //
    }
}
