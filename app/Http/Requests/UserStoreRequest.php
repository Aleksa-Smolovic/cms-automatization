<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserStoreRequest extends FormRequest
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
    public function rules()
    {
        return $this->is('admin/users/store') ? $this->createRules() : $this->updateRules();
    }

    public function messages()
    {
        return [
            'role_id.required' => 'Morate odabrati korisničku ulogu!',
            'full_name.required' => 'Morate unijeti ime i prezime!',
            'email.required' => 'Morate unijeti email!',
            'email.email' => 'Morate unijeti validan email!',
            'email.unique' => 'Korisnik sa datim email-om već postoji!',
            'password.required' => 'Morate unijeti password!',
            'password.min' => 'Password mora sadržati minimum 6 karaktera!',
            'password.confirmed' => 'Morate potvrditi password!'
        ];
    }

    public function createRules(){
        return [
            'role_id'    => 'required',
			'full_name' => 'required',
			'email'      => 'required|email|unique:users',
			'password'   => 'required|min:6|confirmed'
        ];
    }

    public function updateRules(){
        return [
            'role_id'    => 'required',
			'full_name' => 'required',
			'email'      => 'required|email|unique:users,email,' . $this->route('user')->id,
			'password'   => 'nullable|min:6|confirmed'
        ];
    }

    public function validated()
    {
        if($this->password){
            return array_merge(parent::validated(), [
                'password' => Hash::make($this->password, ['rounds' => 12])
            ]);
        }else{
         return array_filter(parent::validated());
        }
    }
    
}
