<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleOwnerHistory;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

use function Symfony\Component\Clock\now;

class VehicleForm extends Form
{
    public ?Vehicle $vehicle = null;
    public $brand;
    public $model;
    public $license_plate;
    public int|string $year;
    public int|string $price;
    public $user_id;

    // Lista para poblar el select (id -> "Nombre Apellido")
    public array $owners = [];

    protected function rules(): array{
        return[
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'license_plate' => ['required', 'string', 'max:255',
                Rule::unique('vehicles', 'license_plate')->ignore($this->vehicle?->id),
            ],

            'year' => ['required', 'integer', 'between:1900,' . (date('Y') + 1)],
            'price' => ['required', 'integer', 'min:0'],
            //dueño debe existir en users
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
        ];
    }

    public function setVehicle(Vehicle $vehicle){
        $this->vehicle = $vehicle;     // Se escoge cada una de las propiedades del validate y las settea con lo que venga del Vehicle.
        $this->brand = $vehicle->brand;
        $this->model = $vehicle->model;
        $this->license_plate = $vehicle->license_plate;
        $this->year = $vehicle->year;
        $this->price = $vehicle->price;
        $this->user_id = $vehicle->user_id;
    }

    // Obtiene un array de todos los usuarios con su nombre y apellidos.
    public function mountOwners(): void{
        $this->owners = User::query()           // Crea un "quey builder" para la tabla users
            // Le dice a la DB ordena por nombre y si empatan en nombre, por apellido.
            ->orderBy('name')
            ->orderBy('last_name')
            // Se ejecuta la consulta que devuelve una Collection de Users.
            ->get()
            // Transforma esa colección a un formato clave ($u->id) => valor ("Nombre Apellido")
            ->mapWithKeys(fn ($u) => [$u->id => trim($u->name.' '.$u->last_name)])
            ->toArray();
    }

    //Función para guardar los datos.
    public function store() : void{
        $this->validate();

        // Este es el insert en la tabla Vehiculos. Se captura el Vehiculo para crear su historial inicial.
        $vehicle = Vehicle::create([
            'brand' => $this->brand,
            'model' => $this->model,
            'license_plate' => $this->license_plate,
            'year' => $this->year,
            'price' => $this->price,
            'user_id' => $this->user_id,
        ]);

        //En el momento en que se crea el vehiculo, se registra un historial inicial del dueño del vehículo.

        VehicleOwnerHistory::create([
            'vehicle_id'=> $vehicle->id,
            'user_id' => $this->user_id,
            'assigned_at' => now(),
            'unassigned_at' => null,
        ]);
    }
    public function update() : void{
        $this->validate();

        //Se captura el antiguo dueño para actualizar el historial en caso de que el auto tenga nuevo dueño.
        $oldUserId = $this->vehicle->user_id;

        // Trae todas las propiedades públicas de ese método. Actualiza el usuario con todas las propiedades.
        $this->vehicle->update([
            'brand' => $this->brand,
            'model' => $this->model,
            'license_plate' => $this->license_plate,
            'year' => $this->year,
            'price' => $this->price,
            'user_id' => $this->user_id,
        ]);

        //Si cambió el dueño, se actualiza el historial.
        if ($oldUserId != $this->user_id){
            // Se cierra el historia anterior.
            VehicleOwnerHistory::where('vehicle_id', $this->vehicle->id)
                ->whereNull('unassigned_at')
                ->update(['unassigned_at' => now()]);

            // Crea un nuevo historial
            VehicleOwnerHistory::create([
                'vehicle_id'=> $this->vehicle->id,
                'user_id' => $this->user_id,
                'assigned_at' => now(),
                'unassigned_at' => null,
            ]);
        }
    }
}
