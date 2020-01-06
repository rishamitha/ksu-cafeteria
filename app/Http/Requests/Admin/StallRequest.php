<?php

namespace App\Http\Requests\Admin;

use App\Models\Stall;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isMethod('patch')) {
            $stall = $this->route('stall');

            return (Auth::check() && Auth::id() == $stall->id);
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
        return [
            'name' => 'required|max:200',
            'description' => 'required|max:800',
            'image' => 'nullable|max:6000',
        ];
    }
}
