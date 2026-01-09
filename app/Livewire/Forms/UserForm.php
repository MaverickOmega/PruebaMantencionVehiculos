<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Hash;

class UserForm extends Form
{
    //Validaciones: Esos son los que muestran mensajes del por qué no se creó el usuario.
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('required|string|max:255')]
    public $last_name=null;
    #[Validate('required|string|email|max:255|unique:users,email')]
    public $email;

    //Función para guardar los datos.
    public function store(){
        $this->validate();

        // Este es el insert en la tabla Users.
        User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make('password'),
        ]);
    }
}
