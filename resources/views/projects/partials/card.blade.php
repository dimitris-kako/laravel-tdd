<div class="card" style="height: 200px;">
    <div>
        <h3 class="font-normal text-xl py-4 mb-4 -ml-5 border-l-4 border-blue-500 pl-4">
            <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
        </h3>
        <div class="text-gray-500">{{ Str::limit($project->description, 50) }}</div>
    </div>
</div>

