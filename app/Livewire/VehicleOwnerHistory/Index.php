<?php

namespace App\Livewire\VehicleOwnerHistory;
use App\Models\VehicleOwnerHistory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public function render()
    {
        //$histories se encarga de traer desde la base de datos los registros del historial listos para ser mostrados en la tabla.

        //with([...]) asegura que vehicle y user vienen cargades en una sola consulta extra por relación, no una por fila

        $histories = VehicleOwnerHistory::query()
            ->with([
                'vehicle:id,brand,model,license_plate',
                'user:id,name,last_name',
            ])
            ->orderByDesc('assigned_at')
            ->paginate(10);

        return view('livewire.vehicle-owner-history.index', [
            'histories' => $histories,
        ]);
    }
}
