<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuctionRequest extends FormRequest
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
            "name"=>"required",
            "description"=>"required",
            "category_id"=>"required|exists:categories,id",
            "initial_price"=>"required",
            "type"=>"required",Rule::in(['scheduled', 'live']),
            "start_date"=>"required",
            "end_date"=>"required",
            "images"=>"required|array",
        ];
    }
}
