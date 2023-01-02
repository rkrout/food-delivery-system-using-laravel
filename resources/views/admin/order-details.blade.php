
<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>qty</th>
            <th>price</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $detail)
        <tr>
            <td>{{ $detail->id }}</td>
            <td>{{ $detail->name }}</td>
            <td>{{ $detail->qty }}</td>
            <td>{{ $detail->price }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{ route('admin.orders.update', ['order' => $order->id]) }}" method="post">
    @csrf
    <select name="delivery_agent_id" id="">
        @foreach ($delivery_agents as $delivery_agent)
            <option @if ($order->delivery_agent_id == $delivery_agent->id) selected  @endif value="{{ $delivery_agent->id }}">{{ $delivery_agent->name }}</option>
        @endforeach
    </select>
    <select name="order_status_id" id="">
        @foreach ($statuses as $status)
            <option @if ($status->id == $order->order_status_id) selected  @endif value="{{ $status->id }}">{{ $status->name }}</option>
        @endforeach
    </select>
    <button type="submit">save</button>
</form>

{{ $address->name}} - name <br>
{{ $address->street}} - street <br>
{{ $address->mobile}} - mobile <br>
{{ $address->instruction}} - instruction <br> <br> <br>

{{ $order->total_price }} - total_price <br>
{{ $order->delivery_fee }} - delivery_fee <br>
{{ $order->gst_percentage }} - gst_percentage