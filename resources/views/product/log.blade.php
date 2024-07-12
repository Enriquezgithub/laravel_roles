<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Activity Logs') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div>
            <table class="w-full">
                <thead class="bg-gray-600 text-white">
                    <tr>
                        <th class="text-left p-2 tracking-wider">Timestamp</th>
                        <th class="text-left tracking-wider">Log entry</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($logs as $logs)
                        <tr>
                            <td class="p-2">{{ $logs->created_at }}</td>
                            <td>{{ $logs->log_entry }} - {{ $logs->user->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No Entry Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
