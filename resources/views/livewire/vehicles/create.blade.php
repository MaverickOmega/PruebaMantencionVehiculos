<div>
    <form wire:submit='save' class="space-y-4 max-w-2xl p-4 bg-surface-alt dark:bg-surface-dark-alt rounded-lg shadow-md">
        <x-form.input wire:model='form.brand' label="Marca" name="form.brand" placeholder="Ingrese la marca"/>
        <x-form.input wire:model='form.model' label="Modelo" name="form.model" placeholder="Ingrese el modelo"/>
        <x-form.input wire:model='form.license_plate' label="Patente" name="form.license_plate" placeholder="Ingrese la patente"/>
        <x-form.input wire:model='form.year' label="Año" name="form.year" placeholder="Ingrese el año"/>
        <x-form.input wire:model='form.price' label="Precio" name="form.price" placeholder="Ingrese el precio"/>
        <div class="relative flex w-full max-w-xs flex-col gap-1 text-on-surface dark:text-on-surface-dark">
            <label for="owner" class="w-fit pl-0.5 text-sm">Dueño del auto</label>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="absolute pointer-events-none right-4 top-8 size-5">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
            <select id="owner" name="form.user_id" wire:model="form.user_id" class="w-full appearance-none rounded-radius border border-outline bg-surface-alt px-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                <option value="">Seleccione un dueño</option>
                @foreach($form->owners as $id => $label)
                    <option value="{{ $id }}">{{ $label }}</option>
                @endforeach
            </select>
            @error('form.user_id')
                <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            {{ request()->routeIs('vehicles.create') ? 'Crear vehiculo' : 'Editar vehiculo' }}
        </button>
    </form>
</div>
