<?php

namespace App\Http\Requests\Admin;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->isMethod('patch')) {
            $menu = Menu::find($this->route('menu'))->first();

            return (Auth::check() && Auth::id() == $menu->stall_id);
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
            'name'        => 'required|max:20',
            'description' => 'nullable|max:500',
            'price'       => 'required|integer|min:1',
            'image'       => 'required',

        ];

        if ($this->isMethod('post')) {
            $rules = array_merge($rules, [
                'image' => 'required|max:6000',
            ]);
        } else {
            $rules = array_merge($rules, [
                'image' => 'nullable|mimes:jpg,jpeg,png|max:6000',
            ]);
        }

        return $rules;
    }
}
