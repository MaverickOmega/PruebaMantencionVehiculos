<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserForm extends Form
{
    public ?User $user;
    public $name;
    public $last_name=null;
    public $email;
    protected function rules(){
        return[
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($this->user?->id),
            ],
        ];
    }
    //Validaciones: Esos son los que muestran mensajes del por qué no se creó el usuario.
    /*
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('required|string|max:255')]
    public $last_name=null;
    #[Validate('required|string|email|max:255|unique:users,email')]
    public $email;
    */

    public function setUser(User $user){
        $this->user = $user;     // Se escoge cada una de las propiedades del validate y las settea con lo que venga del User.
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
    }

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

    public function update(){
        $this->validate();
        // Trae todas las propiedades públicas de ese método. Actualiza el usuario con todas las propiedades.
        $this->user->update([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ]);
    }
}
