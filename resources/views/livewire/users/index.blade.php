<div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
    <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
        <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark-strong">
            <tr>
                <th scope="col" class="p-4">ID</th>
                <th scope="col" class="p-4">Nombre</th>
                <th scope="col" class="p-4">Apellidos</th>
                <th scope="col" class="p-4">Correo</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-outline dark:divide-outline-dark">
            @forelse ($users as $user)                
                <tr>
                    <td class="p-4">{{ $user->id }}</td>
                    <td class="p-4">{{ $user->name }}</td>
                    <td class="p-4">{{ $user->last_name }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center">Users not found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">
        {{ $users->links() }}
    </div>
</div>

