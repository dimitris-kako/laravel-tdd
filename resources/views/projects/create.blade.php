<form method="post" action="{{ route('projects.store') }}">
    @csrf
    <input type="text" name="title">
    <textarea name="description" id="" cols="30" rows="10"></textarea>
    <button type="submit">Submit</button>
</form>
