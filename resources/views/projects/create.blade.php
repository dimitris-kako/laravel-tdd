<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1 class="heading inset-1">Create New</h1>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="container" method="post" action="{{ route('projects.store') }}">
                    @csrf
                    <div class="field">
                        <label class="label" for="title">Title</label>

                        <div class="control">
                            <input type="text" class="input" name="title">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label" for="description">Description</label>

                        <div class="control">
                            <textarea class="textarea" name="description"></textarea>
                        </div>

                    </div>

                    <div class="field">
                        <div class="control">
                            <button type="submit" class="btn is-link">Submit</button>
                            <a href="{{ route('projects.index') }}">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
</x-app-layout>

