<?php
namespace App\Http\Requests\UserData;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Tentukan apakah user diizinkan untuk melakukan request ini
        return true; // Atau bisa disesuaikan dengan logika otorisasi
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id', // Harus sesuai dengan id di tabel users
            'username' => 'required|string|unique:user_datas,username|min:3|max:20|regex:/^[a-zA-Z0-9_.]+$/',
            'full_name' => 'required|string|regex:/^[a-zA-Z ]+$/',
            'phone' => ['required', 'numeric', 'regex:/^62\d{9,}$/'],
        ];        
    }

    /**
     * Customize the error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.regex' => 'Nomor telepon harus dimulai dengan kode negara 62.',
        ];
    }
}
