<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Task Details') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    Edit Task
                </a>
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Tasks
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <h3 class="text-2xl font-bold">{{ $task->title }}</h3>
                        </div>

                        <!-- Badges -->
                        <div class="flex gap-2">
                            <!-- Priority Badge -->
                            <span class="px-3 py-1 text-sm rounded
                                @if($task->priority == 'high') bg-red-100 text-red-800
                                @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800
                                @endif">
                                Priority: {{ ucfirst($task->priority) }}
                            </span>

                            <!-- Status Badge -->
                            <span class="px-3 py-1 text-sm rounded
                                @if($task->status == 'completed') bg-green-100 text-green-800
                                @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                Status: {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>

                            <!-- Category Badge -->
                            @if($task->category)
                                <span class="px-3 py-1 text-sm rounded" style="background-color: {{ $task->category->color }}22; color: {{ $task->category->color }};">
                                    {{ $task->category->name }}
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        @if($task->description)
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Description</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $task->description }}</p>
                            </div>
                        @endif

                        <!-- Due Date -->
                        @if($task->due_date)
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Due Date</h4>
                                <p class="{{ $task->isOverdue() ? 'text-red-500 font-semibold' : 'text-gray-700' }}">
                                    📅 {{ $task->due_date->format('F d, Y') }}
                                    @if($task->isOverdue())
                                        <span class="ml-2 text-sm">(Overdue by {{ $task->due_date->diffForHumans() }})</span>
                                    @else
                                        <span class="ml-2 text-sm">({{ $task->due_date->diffForHumans() }})</span>
                                    @endif
                                </p>
                            </div>
                        @endif

                        <!-- Timestamps -->
                        <div class="border-t pt-4">
                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <strong>Created:</strong> {{ $task->created_at->format('M d, Y h:i A') }}
                                </div>
                                <div>
                                    <strong>Last Updated:</strong> {{ $task->updated_at->format('M d, Y h:i A') }}
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="border-t pt-4">
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                onsubmit="return confirm('Are you sure you want to delete this task? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete Task
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
