<?php

namespace App\Http\Requests\Admin\Tree;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WorkingHourRequest extends FormRequest
{
    public function rules()
    {
        return [
            'morning' => 'required|array',
            'morning.start_time' => 'nullable|max:4|min:4',
            'morning.end_time' => 'nullable|max:4|min:4',
            'morning.break_time' => 'nullable|numeric',
            'afternoon' => 'required|array',
            'afternoon.start_time' => 'nullable|max:4|min:4',
            'afternoon.end_time' => 'nullable|max:4|min:4',
            'afternoon.break_time' => 'nullable|numeric',
            'night' => 'required|array',
            'night.start_time' =>  'nullable|max:4|min:4',
            'night.end_time' =>  'nullable|max:4|min:4',
            'night.break_time' =>  'nullable|numeric',
            'full' => 'required|array',
            'full.start_time' => 'nullable|max:4|min:4',
            'full.end_time' => 'nullable|max:4|min:4',
            'full.break_time' => 'nullable|numeric',
            'report' => 'required|array',
            'report.start_time' => 'nullable|max:4|min:4',
            'report.end_time' => 'nullable|max:4|min:4',
            'report.break_time' => 'nullable|numeric',
            'annual' => 'required|array',
            'annual.start_time' => 'nullable|max:4|min:4',
            'annual.end_time' => 'nullable|max:4|min:4',
            'annual.break_time' => 'nullable|numeric',
            'permit' => 'required|array',
            'permit.start_time' => 'nullable|max:4|min:4',
            'permit.end_time' => 'nullable|max:4|min:4',
            'permit.break_time' => 'nullable|numeric',
        ];
    }
}
