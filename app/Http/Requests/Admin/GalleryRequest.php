<?php

namespace App\Http\Requests\Admin;

use App\Models\Gallery;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isMethod('patch')) {
            $gallery = Gallery::find($this->route('gallery'))->first();

            return (Auth::check() && Auth::id() == $gallery->stall_id);
        }

        return (Auth::check());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'caption' => 'nullable|max:50',
        ];

        if ($this->isMethod('post')) {
            $rules = array_merge($rules, [
                'image' => 'required|max:6000',
            ]);
        } else {
            $rules = array_merge($rules, [
                'image' => 'nullable|max:6000',
            ]);
        }

        return $rules;
    }
}
