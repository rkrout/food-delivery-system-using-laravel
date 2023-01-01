<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>delivery_fee</th>
            <th>gst_percentage</th>
            <th>total_price</th>
            <th>order_status</th>
            <th>id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->delivery_fee }}</td>
            <td>{{ $order->gst_percentage }}</td>
            <td>{{ $order->total_price }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <a href="{{ route('orders.orderdetails', ['order' => $order->id ]) }}">details</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>