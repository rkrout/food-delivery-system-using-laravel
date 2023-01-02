
<a href="{{ route('admin.categories.create') }}">create</a> 
<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>total_foods</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <img src="{{ $category->image_url }}" width="60">
            </td>
            <td>{{ $category->total_foods }}</td>
            <td>{{ $category->created_at }}</td>
            <td>{{ $category->updated_at }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">edit</a>
                <form action="{{ route('admin.categories.delete', ['category' => $category->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="category" value="{{ $category->id }}">
                    <button>delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
{{ $categories->links() }}