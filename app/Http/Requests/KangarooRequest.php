<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KangarooRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->kangaroo?->id;
        return [
            'name' => "required|unique:kangaroos,name,$id",
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'gender' => 'required|in:male,female',
            'friendliness' => 'in:friendly,not friendly',
            'birthday' => 'required|date|before:today'
        ];
    }
}
