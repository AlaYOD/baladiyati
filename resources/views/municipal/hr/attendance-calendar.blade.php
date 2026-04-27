<div class="border rounded-xl shadow-sm bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 p-6">
    <div class="mb-4 flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Attendance Overview</h3>
        <span class="px-3 py-1 text-sm bg-primary-100 text-primary-700 dark:bg-primary-900 dark:text-primary-300 rounded-full">Current Month</span>
    </div>

    @php
        $records = $getRecord()->attendanceRecords()->latest('date')->take(7)->get();
    @endphp

    @if($records->isEmpty())
        <div class="text-center py-6 text-gray-500 dark:text-gray-400">
            <x-heroicon-o-calendar class="mx-auto h-12 w-12 text-gray-400" />
            <p class="mt-2 text-sm">No attendance records found for this employee.</p>
        </div>
    @else
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100 sm:pl-6">Date</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Status</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Check In</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Check Out</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-900">
                    @foreach($records as $record)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-gray-100 sm:pl-6">{{ $record->date->format('l, M j') }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                <x-filament::badge :color="match($record->status) {
                                    'present' => 'success',
                                    'absent' => 'danger',
                                    'leave' => 'warning',
                                    default => 'gray',
                                }">
                                    {{ ucfirst($record->status) }}
                                </x-filament::badge>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ $record->check_in ? \Carbon\Carbon::parse($record->check_in)->format('g:i A') : '--' }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ $record->check_out ? \Carbon\Carbon::parse($record->check_out)->format('g:i A') : '--' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
