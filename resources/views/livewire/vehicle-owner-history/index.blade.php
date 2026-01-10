<div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
    <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
        <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
            <tr>
                <th scope="col" class="p-4">ID</th>
                <th scope="col" class="p-4">Vehiculo</th>
                <th scope="col" class="p-4">Dueño</th>
                <th scope="col" class="p-4">Desde</th>
                <th scope="col" class="p-4">Hasta</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline dark:divide-outline-dark">
            @forelse ($histories as $h)
                <tr>
                    <td class="p-4">{{ $h->id }}</td>
                    <td class="p-4">{{ $h->vehicle->brand }} {{ $h->vehicle->model }}  {{ $h->vehicle->license_plate }}</td>
                    <td class="p-4">{{ $h->user->name }} {{ $h->user->last_name }}</td>
                    <td class="p-4">{{ optional($h->assigned_at)->format('d-m-Y H:i') }}</td>
                    <td class="p-4">{{ $h->unassigned_at ? $h->unassigned_at->format('d-m-Y H:i') : 'Actual' }}</td>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center">Historiales no registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $histories->links() }}
    </div>
</div>

