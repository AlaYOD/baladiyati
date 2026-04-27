<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Request Details -->
        <div class="md:col-span-2 space-y-6">
            <x-filament::section icon="heroicon-o-document-text" icon-color="primary">
                <x-slot name="heading">Citizen Submission</x-slot>
                <x-slot name="description">Detailed data provided by the applicant.</x-slot>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                    @if($record->payload)
                        @foreach($record->payload as $key => $value)
                            <div class="border-b border-gray-100 dark:border-gray-800 pb-3">
                                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-1">{{ str_replace('_', ' ', $key) }}</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    @if(is_array($value))
                                        <pre class="text-xs bg-gray-50 dark:bg-gray-900 p-2 rounded mt-1">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                    @else
                                        {{ $value }}
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500 italic">No payload data available.</p>
                    @endif
                </div>
            </x-filament::section>

            @if($record->notes)
                <x-filament::section icon="heroicon-o-chat-bubble-bottom-center-text" icon-color="warning">
                    <x-slot name="heading">Internal Case Notes</x-slot>
                    <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ $record->notes }}
                    </div>
                </x-filament::section>
            @endif
        </div>

        <!-- Sidebar: Info & Timeline -->
        <div class="space-y-6">
            <x-filament::section>
                <x-slot name="heading">Status & Information</x-slot>
                
                <div class="space-y-5">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Service Type</span>
                        <span class="text-sm font-semibold px-2 py-1 bg-gray-100 dark:bg-gray-800 rounded-lg text-gray-700 dark:text-gray-300">{{ $record->service->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Applicant</span>
                        <span class="text-sm font-medium">{{ $record->user->name }}</span>
                    </div>
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 block mb-2">Current Status</span>
                        <x-filament::badge :color="match($record->status) {
                            'pending' => 'warning',
                            'under_review' => 'info',
                            'awaiting_payment' => 'primary',
                            'completed' => 'success',
                            'rejected' => 'danger',
                            default => 'gray',
                        }" size="lg" class="w-full justify-center">
                            {{ ucfirst(str_replace('_', ' ', $record->status)) }}
                        </x-filament::badge>
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section icon="heroicon-o-clock">
                <x-slot name="heading">Process Timeline</x-slot>
                
                <div class="flow-root mt-4">
                    <ul role="list" class="-mb-8">
                        <li>
                            <div class="relative pb-8">
                                <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-primary-500 flex items-center justify-center ring-8 ring-white dark:ring-gray-900">
                                            <x-heroicon-m-plus-circle class="h-5 w-5 text-white" />
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">Application Submitted</p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-xs text-gray-500">
                                            {{ $record->created_at->format('M d') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full {{ $record->status === 'completed' ? 'bg-success-500' : 'bg-gray-300' }} flex items-center justify-center ring-8 ring-white dark:ring-gray-900">
                                            <x-heroicon-m-arrow-path-solid class="h-5 w-5 text-white {{ $record->status !== 'completed' ? 'animate-spin-slow' : '' }}" />
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ ucfirst(str_replace('_', ' ', $record->status)) }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Last updated {{ $record->updated_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </x-filament::section>
        </div>
    </div>
</x-filament-panels::page>
