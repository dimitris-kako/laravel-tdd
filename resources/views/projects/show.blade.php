<x-app-layout>
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full">
            <p class="text-gray-500 text-sm font-normal"><a href="{{route('projects.index')}}">My Projects</a> / {{ $project->title }}</p>
            <a href="{{ route('projects.create') }}" class="button">Create New</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-gray-500 font-normal mb-3">Tasks</h2>

                    <div class="card mb-3">
                        Lorem Ipsum
                    </div>

                    <div class="card mb-3">
                        Lorem Ipsum
                    </div>
                    <div class="card mb-3">
                        Lorem Ipsum
                    </div>
                    <div class="card mb-3">
                        Lorem Ipsum
                    </div>
                </div>

                <div>
                    <h2 class="text-gray-500 font-normal mb-3">General Notes</h2>

                    <textarea class="card w-full" style="min-height: 200px;"></textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.partials.card')
            </div>
        </div>

    </main>
</x-app-layout>

