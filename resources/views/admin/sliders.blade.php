@include('admin.base')
<a href="{{ route('admin.sliders.create') }}">create</a> 
<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>image</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sliders as $slider)
        <tr>
            <td>{{ $slider->id }}</td>
            <td>
                <img src="{{ $slider->image_url }}" width="60">
            </td>
            <td>{{ $slider->created_at }}</td>
            <td>{{ $slider->updated_at }}</td>
            <td>
                <form action="{{ route('admin.sliders.delete', ['slider' => $slider->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="category" value="{{ $slider->id }}">
                    <button>delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
