<?php

namespace App\Http\Controllers;

use App\EloquentModels\Tourist;
use Illuminate\Http\Request;
use Validator;

class TouristController extends Controller
{

    public array $rules = [
        'params.name' => ['required', 'string', 'max:255'],
        'params.name_lat' => ['required', 'string', 'max:255'],
        'params.gender' => ['required', 'in:f,m'],
        'params.address' => ['required', 'string', 'max:255'],
        'params.tel' => ['nullable', 'string', 'max:255'],
        'params.email' => ['nullable', 'string', 'max:255'],
        'params.passport_series' => ['nullable', 'string', 'max:255'],
        'params.passport_number' => ['nullable', 'string', 'max:255'],
        'params.passport_who' => ['nullable', 'string', 'max:255'],
        'params.passport_when' => ['nullable', 'date_format:Y-m-d'],
        'params.passport_till' => ['nullable', 'date_format:Y-m-d'],
        'params.passport_series_rus' => ['nullable', 'string', 'max:255'],
        'params.passport_number_rus' => ['nullable', 'string', 'max:255'],
        'params.passport_who_rus' => ['nullable', 'string', 'max:255'],
        'params.passport_when_rus' => ['nullable', 'date_format:Y-m-d'],
        'params.dr' => ['nullable', 'date_format:Y-m-d'],
        'params.receive_sms' => ['nullable', 'boolean'],
        'params.receive_email' => ['nullable', 'boolean'],
        'params.manager_id' => ['required', 'integer'],
        'params.office_id' => ['required', 'integer'],
        'params.groups' => ['nullable', 'array'],
        'params.contacts' => ['nullable', 'array'],
        'params.vk' => ['nullable', 'json'],
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        (new Tourist())->newQuery()->create($this->getData($request));

        return response()->json([
            'success' => 1,
            'desc' => 'Tourist succesfully created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EloquentModels\Tourist  $tourist
     * @return \Illuminate\Http\Response
     */
    public function show(Tourist $tourist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), array_merge($this->rules, [
            'params.id' => ['required', 'integer', 'exists:App\EloquentModels\Tourist,id']
        ]));

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        (new Tourist())->newQuery()->where('id', $request->input('params.id'))->update($this->getData($request));

        return response()->json([
            'success' => 1,
            'desc' => 'Tourist succesfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EloquentModels\Tourist  $tourist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tourist $tourist)
    {
        //
    }

    public function getData(Request $request)
    {
        return [
            'user_id' => $request->user()->id,
            'name' => $request->input('params.name'),
            'name_lat' => $request->input('params.name_lat'),
            'gender' => $request->input('params.gender'),
            'address' => $request->input('params.address'),
            'tel' => $request->input('params.tel') ?? '',
            'email' => $request->input('params.email') ?? '',
            'passport_series' => $request->input('params.passport_series') ?? '',
            'passport_number' => $request->input('params.passport_number') ?? '',
            'passport_who' => $request->input('params.passport_who') ?? '',
            'passport_when' => $request->input('params.passport_when'),
            'passport_till' => $request->input('params.passport_till'),

            'passport_series_rus' => $request->input('params.passport_series_rus') ?? '',
            'passport_number_rus' => $request->input('params.passport_number_rus') ?? '',
            'passport_who_rus' => $request->input('params.passport_who_rus') ?? '',
            'passport_when_rus' => $request->input('params.passport_when_rus'),

            'dr' => $request->input('params.dr'),
            'receive_sms' => $request->input('params.receive_sms'),
            'receive_email' => $request->input('params.receive_email'),
            'manager_id' => $request->input('params.manager_id'),
            'office_id' => $request->input('params.office_id'),

            'groups' => json_encode($request->input('params.groups') ?? []),
            'contacts' => json_encode($request->input('params.contacts') ?? []),

            'vk' => $request->input('params.vk') ?? '',
        ];
    }
}
