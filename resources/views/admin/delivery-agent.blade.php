
@include('admin.base')
<a href="{{ route('admin.delivery-agents.create') }}">create</a> 
<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>delivery done</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($delivery_agents as $delivery_agent)
        <tr>
            <td>{{ $delivery_agent->id }}</td>
            <td>{{ $delivery_agent->name }}</td>
            <td>{{ $delivery_agent->email }}</td>
            <td>{{ $delivery_agent->total_delivery }}</td>
            <td>{{ $delivery_agent->created_at }}</td>
            <td>{{ $delivery_agent->updated_at }}</td>
            <td>
                <form action="{{ route('admin.delivery-agents.delete', ['user' => $delivery_agent->id]) }}" method="post">
                    @csrf
                    <button>delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
