<?php

namespace App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
    // untuk Validasi agar field tidak boleh di isi kosong
    // cara pembuatan : php artisan make:request Admin\\GalleryRequest
    public function rules()
    {
        return [
            'transaction_status' => 'required|string|in:IN_CART,PENDING,SUCCESS,CANCEL,FAILED'
            // isi dari Field database untuk di validasi
        ];
    }
}
