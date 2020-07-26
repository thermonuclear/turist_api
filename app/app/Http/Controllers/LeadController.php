<?php

namespace App\Http\Controllers;

use App\EloquentModels\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Добавление лида
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'params.name' => ['required', 'string', 'max:255'],
            'params.phone' => ['nullable', 'string', 'max:255'],
            'params.email' => ['nullable', 'email'],
            'params.source' => ['nullable', 'string', 'max:255'],
            'params.fields' => ['nullable', 'array'],
        ]);

        (new Lead())->newQuery()->create([
            'lead_user_id' => $request->user()->id,
            'lead_name' => $request->input('params.name'),
            'lead_phone' => $request->input('params.phone'),
            'lead_email' => $request->input('params.email'),
            'lead_source' => $request->input('params.source'),
            'lead_fields' => json_encode($request->input('params.fields') ?? []),
        ]);

        //return $request->params;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EloquentModels\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EloquentModels\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EloquentModels\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        //
    }
}
