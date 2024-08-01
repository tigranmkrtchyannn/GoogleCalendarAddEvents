<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|nullable',
            'start' => 'required|date',
            'end'=> 'required|date|after:start',
        ];
    }
    public function messages() {
        return [
            'title.required' => 'Event title is required',
            'description.required' => 'Event description is required',
            'description.string' => 'Event description must be a string',
            'start.required' => 'Event start date is required',
            'start.date' => 'Event start date must be a date',
            'end.required' => 'Event end date is required',
            'end.date' => 'Event end date must be a date',
            'end.after' => 'Event end date must be after start date',
        ];
    }
}
