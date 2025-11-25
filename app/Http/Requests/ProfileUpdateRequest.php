<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                Rule::unique(User::class)->ignore($this->user()->id)
            ],

            'username' => [
                'required', // Atau 'nullable' jika tidak wajib
                'string', 
                'max:255', 
                Rule::unique(User::class)->ignore($this->user()->id)
            ],

            // --- KOLOM DAERAH SESUAI MODEL USER ---
            'province' => ['nullable', 'string', 'max:255'],
            'regency'  => ['nullable', 'string', 'max:255'], // Menggantikan 'city'
            'district' => ['nullable', 'string', 'max:255'],
            
            // Catatan: 
            // - 'phone', 'village', 'address' dihapus karena tidak ada di $fillable User.
            // - 'xp', 'level', 'points', 'role' tidak dimasukkan agar user 
            //   tidak bisa memanipulasi nilai tersebut melalui form edit profile.
        ];
    }
}