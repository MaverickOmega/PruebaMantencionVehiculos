<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Forms\UserForm;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class Create extends Component
{
    public UserForm $form;

    public function save(){

        // Guarda los datos usando el método del UserForm.
        $this->form->store();

        session()->flash('success', 'User sucessfully created.');
        // Redirect despues de crear.
        $this->redirectRoute('users.index', navigate: true);
        
    }
    public function render()
    {
        return view('livewire.users.create');
    }
}
