<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TanggalRequest extends FormRequest
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
            "tanggal_mulai" => "required|after:today|date_format:Y-m-d",
            // "tanggal_selesai" => "required|date_format:Y-m-d|after:tanggal_mulai",
        ];
    }

    public function messages(): array
    {
        return [
            "tanggal_mulai.required" => "Tanggal Harus Diisi",
            "tanggal_mulai.after" => "Tanggal  Harus Lebih Dari Hari Ini",
            "tanggal_mulai.date_format" => "Tanggal  Harus Y-m-d",
            // "tanggal_selesai.required" => "Tanggal Harus Diisi",
            // "tanggal_selesai.after" => "Tanggal Selesai Harus Setelah Tanggal Mulai",
            // "tanggal_selesai.date_format" => "Tanggal  Harus Y-m-d",
        ];
    }
}
