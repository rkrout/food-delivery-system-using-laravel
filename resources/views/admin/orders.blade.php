
<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>total_items</th>
            <th>total_amount</th>
            <th>status</th>
            <th>delivery_agent</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->total_items }}</td>
            <td>{{ $order->total_amount }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->delivery_agent }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->updated_at }}</td>
            <td>
                <a href="{{ route('admin.orders.view', ['order' => $order->id]) }}">view</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
{{ $orders->links() }}