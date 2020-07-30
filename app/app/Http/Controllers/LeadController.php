<?php

namespace App\Http\Controllers;

use App\EloquentModels\Lead;
use Illuminate\Http\Request;
use Validator;

class LeadController extends Controller
{
    /**
     * Добавление лида
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'params.name' => ['required', 'string', 'max:255'],
            'params.phone' => ['nullable', 'string', 'max:255'],
            'params.email' => ['nullable', 'email'],
            'params.source' => ['nullable', 'string', 'max:255'],
            'params.fields' => ['nullable', 'array'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        (new Lead())->newQuery()->create([
            'lead_user_id' => $request->user()->id,
            'lead_name' => $request->input('params.name'),
            'lead_phone' => $request->input('params.phone'),
            'lead_email' => $request->input('params.email'),
            'lead_source' => $request->input('params.source'),
            'lead_fields' => json_encode($request->input('params.fields') ?? []),
        ]);

        return response()->json([
            'success' => 1,
            'desc' => 'Lead succesfully created',
        ]);
    }
}
