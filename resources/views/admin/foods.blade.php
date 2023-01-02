
<a href="{{ route('admin.foods.create') }}">create</a> 
<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>price</th>
            <th>image</th>
            <th>category</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foods as $food)
        <tr>
            <td>{{ $food->id }}</td>
            <td>{{ $food->name }}</td>
            <td>{{ $food->price }}</td>
            <td>
                <img src="{{ $food->image_url }}" width="60">
            </td>
            <td>{{ $food->category }}</td>
            <td>{{ $food->created_at }}</td>
            <td>{{ $food->updated_at }}</td>
            <td>
                <a href="{{ route('admin.foods.edit', ['food' => $food->id]) }}">edit</a>
                <form action="{{ route('admin.foods.delete', ['food' => $food->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="food" value="{{ $food->id }}">
                    <button>delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
{{ $foods->links() }}