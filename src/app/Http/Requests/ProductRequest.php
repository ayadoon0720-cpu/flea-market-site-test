<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required', 'numeric', 'between:0,10000'],
            'image' => ['required', 'mimes:png,jpeg'],
            'season_id' => ['required', 'array'],'season_id.*' => ['exists:seasons,id'],
            'description' => ['required', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '商品名を入力してください',

            'price.required' => '値段を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.between' => '０〜10000円以内で入力してください',

            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください。',

            'season_id.required' => '季節を選択してください',

            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
