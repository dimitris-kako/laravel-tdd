<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full">
            <h2 class="text-gray-500 font-normal">Projects</h2>
                <a href="{{ route('projects.create') }}" class="button">Create New</a>
        </div>


    </header>

    <div class="lg:flex lg:flex-wrap">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.partials.card')
            </div>
        @empty
            <div>
                <p>No projects yet.</p>
            </div>
        @endforelse
    </div>


</x-app-layout>
