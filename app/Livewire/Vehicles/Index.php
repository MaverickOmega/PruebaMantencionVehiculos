<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.vehicles.index', [
            'vehicles' => Vehicle::with('owner')->latest()->paginate(10)
        ]);
    }
}
