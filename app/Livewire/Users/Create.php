<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class Create extends Component
{
    //Validaciones: Esos son los que muestran mensajes del por qué no se creó el usuario.
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('required|string|max:255')]
    public $last_name=null;
    #[Validate('required|string|email|max:255|unique:users,email')]
    public $email;

    public function store(){

        $this->validate();

        // Este es el insert en la tabla Users.
        User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make('password'),
        ]);

        session()->flash('success', 'User sucessfully created.');
        // Redirect despues de crear.
        $this->redirectRoute('users.index', navigate: true);
        
    }
    public function render()
    {
        return view('livewire.users.create');
    }
}
