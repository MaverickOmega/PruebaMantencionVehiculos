<?php

namespace App\Livewire\Users;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;

class Update extends Component
{
    public UserForm $form;

    public function mount(User $user){
        $this->form->setUser($user);
    }
    // Para guardar los cambios.
    public function save(){
        $this->form->update();

        session()->flash('success', 'User sucessfully updated.');
        // Redirect despues de editar.
        $this->redirectRoute('users.index', navigate: true);
    }
    public function render()
    {
        return view('livewire.users.create');
    }
}
