<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

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

        // Este es el insert en la tabla Vehiculos.
        Vehicle::create([
            'brand' => $this->brand,
            'model' => $this->model,
            'license_plate' => $this->license_plate,
            'year' => $this->year,
            'price' => $this->price,
            'user_id' => $this->user_id,
        ]);
    }
}
