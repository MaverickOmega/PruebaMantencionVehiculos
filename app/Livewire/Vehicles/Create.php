<?php

namespace App\Livewire\Vehicles;
use App\Livewire\Forms\VehicleForm;

use Livewire\Component;

class Create extends Component
{
    public VehicleForm $form;
    // Obtener todos los nombres y apellidos de los dueños (users).
    public function mount() : void{
        $this->form->vehicle=NULL;
        $this->form->mountOwners();
    }
    public function save(){

        // Guarda los datos usando el método del VehicleForm.
        $this->form->store();

        session()->flash('success', 'Vehículo creado correctamente.');
        // Redirect despues de crear.
        $this->redirectRoute('vehicles.index', navigate: true);
        
    }
    public function render()
    {
        return view('livewire.vehicles.create');
    }
}
