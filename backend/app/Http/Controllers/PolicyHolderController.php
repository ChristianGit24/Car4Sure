<?php

namespace App\Http\Controllers;

use App\Models\PolicyHolder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PolicyHolderController extends Controller
{
    public function index(): JsonResponse
    {
        $policyHolders = PolicyHolder::all();
        return response()->json($policyHolders);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city' => 'required|string'
        ]);

        $policyHolder = PolicyHolder::create($validatedData);
        return response()->json($policyHolder, 201);
    }

    public function show($id): JsonResponse
    {
        $policyHolder = PolicyHolder::findOrFail($id);
        return response()->json($policyHolder);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $policyHolder = PolicyHolder::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city' => 'required|string'
        ]);

        $policyHolder->update($validatedData);
        return response()->json($policyHolder);
    }

    public function destroy($id): JsonResponse
    {
        $policyHolder = PolicyHolder::findOrFail($id);
        $policyHolder->delete();
        return response()->json(null, 204);
    }
}
