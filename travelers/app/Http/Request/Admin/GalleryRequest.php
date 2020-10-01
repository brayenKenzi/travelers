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
            'travel_packages_id' => 'required|integer|exist:travel_package,id',
            //membuat dari travel_packages_id memang ada di table travel_package
            'image' => 'required|image'
            // isi dari Field database untuk di validasi
        ];
    }
}
