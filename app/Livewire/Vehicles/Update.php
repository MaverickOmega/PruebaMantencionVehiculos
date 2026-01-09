<?php

namespace App\Livewire\Vehicles;

use App\Livewire\Forms\VehicleForm;
use App\Models\Vehicle;
use Livewire\Component;

class Update extends Component
{
    public VehicleForm $form;

    public function mount(Vehicle $vehicle){
        $this->form->mountOwners();
        $this->form->setVehicle($vehicle);
    }
    // Para guardar los cambios.
    public function save(){
        $this->form->update();

        session()->flash('success', 'El vehiculo fue editado.');
        // Redirect despues de editar.
        $this->redirectRoute('vehicles.index', navigate: true);
    }
    public function render()
    {
        return view('livewire.vehicles.create');
    }
}
