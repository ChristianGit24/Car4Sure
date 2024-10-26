<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PolicyController extends Controller
{
    public function index(): JsonResponse
    {
        $policies = Policy::with('policyHolder')->get();
        return response()->json($policies);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'policy_no' => 'required|unique:policies',
            'type' => 'required|in:Auto,Home,Life',
            'status' => 'required|in:Active,Pending,Cancelled',
            'effective_date' => 'required|date',
            'expiration_date' => 'required|date|after:effective_date',
            'policy_holder_id' => 'required|exists:policy_holders,id'
        ]);

        $policy = Policy::create($validatedData);
        return response()->json($policy, 201);
    }

    public function show($id): JsonResponse
    {
        $policy = Policy::with('policyHolder')->findOrFail($id);
        return response()->json($policy);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $policy = Policy::findOrFail($id);

        $validatedData = $request->validate([
            'policy_no' => 'required|unique:policies,policy_no,' . $id,
            'type' => 'required|in:Auto,Home,Life',
            'status' => 'required|in:Active,Pending,Cancelled',
            'effective_date' => 'required|date',
            'expiration_date' => 'required|date|after:effective_date',
            'policy_holder_id' => 'required|exists:policy_holders,id'
        ]);

        $policy->update($validatedData);
        return response()->json($policy);
    }

    public function destroy($id): JsonResponse
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();
        return response()->json(null, 204);
    }
}
