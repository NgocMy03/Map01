<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'chuongtrinhKM' => 'required|string',
            'thoigianapdung' => 'required|date',
            'mucgiamgia' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'thoigianapdung.required' => 'Thời gian áp dụng là bắt buộc.',
            'thoigianapdung.date' => 'Thời gian áp dụng phải là một ngày hợp lệ.',
            'chuongtrinhKM.required' => 'Chương trình khuyến mãi là bắt buộc.',
            'chuongtrinhKM.string' => 'Chương trình khuyến mãi phải là dạng ký tự.',
            'mucgiamgia.required' => 'Mức giảm giá là bắt buộc.',
            'mucgiamgia.exists' => 'Mức giảm giá không hợp lệ. Vui lòng chọn Mức giảm giá hợp lệ từ hệ thống.',
        ];
    }
}
