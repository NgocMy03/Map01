<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
    public function rules()
    {
        return [
            'ngay' => 'required|date', // Ngày làm việc là bắt buộc và phải là một ngày hợp lệ
            'schedule_id' => 'required|exists:schedules,id',
            'trangthai' => 'required|in:Checkin,Checkout', // Trạng thái đơn hàng là bắt buộc và phải là một trong các giá trị đã định nghĩa
            'staff_id' => 'required|exists:staff,id', // Thay 'your_staff_table' bằng tên bảng thực tế
        ];
    }

    public function messages()
    {
        return [
            'ngay.required' => 'Ngày làm việc là bắt buộc.',
            'ngay.date' => 'Ngày làm việc phải là một ngày hợp lệ.',
            'schedule_id.required' => 'Ca làm việc là bắt buộc.',
            'schedule_id.exists' => 'Ca làm việc không tồn tại.',
            'trangthai.required' => 'Trạng thái đơn hàng là bắt buộc.',
            'trangthai.in' => 'Trạng thái đơn hàng không hợp lệ.',
            'staff_id.required' => 'Nhân viên là bắt buộc.',
            'staff_id.exists' => 'Nhân viên không tồn tại.',
        ];
    }
}
