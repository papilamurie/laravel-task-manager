<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Tasks') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" style="background: #000;">
                Create New Task
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('tasks.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">All</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Priority</label>
                            <select name="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">All</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">All</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded w-full">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tasks List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($tasks->count() > 0)
                        <div class="space-y-4">
                            @foreach($tasks as $task)
                                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2">
                                                <h3 class="text-lg font-semibold">{{ $task->title }}</h3>

                                                <!-- Priority Badge -->
                                                <span class="px-2 py-1 text-xs rounded
                                                    @if($task->priority == 'high') bg-red-100 text-red-800
                                                    @elseif($task->priority == 'medium') bg-yellow-100 text-yellow-800
                                                    @else bg-green-100 text-green-800
                                                    @endif">
                                                    {{ ucfirst($task->priority) }}
                                                </span>

                                                <!-- Status Badge -->
                                                <span class="px-2 py-1 text-xs rounded
                                                    @if($task->status == 'completed') bg-green-100 text-green-800
                                                    @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>

                                                <!-- Category Badge -->
                                                @if($task->category)
                                                    <span class="px-2 py-1 text-xs rounded" style="background-color: {{ $task->category->color }}22; color: {{ $task->category->color }};">
                                                        {{ $task->category->name }}
                                                    </span>
                                                @endif
                                            </div>

                                            @if($task->description)
                                                <p class="text-gray-600 mt-2">{{ Str::limit($task->description, 100) }}</p>
                                            @endif

                                            <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                                @if($task->due_date)
                                                    <span class="{{ $task->isOverdue() ? 'text-red-500 font-semibold' : '' }}">
                                                        📅 Due: {{ $task->due_date->format('M d, Y') }}
                                                        @if($task->isOverdue())
                                                            (Overdue)
                                                        @endif
                                                    </span>
                                                @endif
                                                <span>Created: {{ $task->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>

                                        <div class="flex gap-2 ml-4">
                                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                            <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $tasks->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">No tasks found.</p>
                            <a href="{{ route('tasks.create') }}" class="text-blue-600 hover:text-blue-900 mt-2 inline-block">
                                Create your first task
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
