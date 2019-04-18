<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class storeEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_name' => 'required',
            'start_date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i|after_or_equal:09:00|before_or_equal:24:00',
            'end_time' => 'required|date_format:H:i|before_or_equal:24:00|after_or_equal:09:00',
            'end_date' => 'required|date|after_or_equal:start_date',
            'typeEventsId' => 'required|integer|exists:typeevents,id',
            'numPeopleexp' => 'required|integer',
            'roomsId' => 'required|integer',
            'comment'=>'sometimes|string'
        ];
    }


}
