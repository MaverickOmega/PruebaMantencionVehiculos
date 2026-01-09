<div>
    <form wire:submit='store' class="space-y-4 max-w-2xl p-4 bg-surface-alt dark:bg-surface-dark-alt rounded-lg shadow-md">
        <x-form.input wire:model='name' label="Nombre" name="name" placeholder="Ingrese el nombre"/>
        <x-form.input wire:model='last_name' label="Apellidos" name="last_name" placeholder="Ingrese los apellidos"/>
        <x-form.input wire:model='email' label="Correo" name="email" placeholder="Ingrese el correo"/>
        <button type="submit" class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
            Create
        </button>
    </form>
</div>
