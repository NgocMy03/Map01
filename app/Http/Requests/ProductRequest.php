<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'ten' => 'required|string',
            'loai' => 'required|string',
            'gia' => 'required|min:0',
            'hinhanh' => 'required|url',
            //'discount_id' => 'required|exists:discounts,id', // Mã giảm giá phải tồn tại trong bảng discounts
        ];
    }

    public function messages(): array
    {
        return [
            'ten.required' => 'Bạn chưa nhập tên sản phẩm.',
            'ten.string' => 'Tên sản phẩm phải là dạng ký tự.',
            'loai.required' => 'Bạn chưa nhập loại sản phẩm.',
            'loai.string' => 'Loại sản phẩm phải là dạng ký tự.',
            'gia.required' => 'Bạn chưa nhập giá.',
            'gia.min' => 'Giá phải lớn hơn 0.',
        ];
    }
}
