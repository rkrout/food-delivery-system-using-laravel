<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>id</th>
            <th>food</th>
            <th>qty</th>
            <th>price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $d)
        <tr>
            <td>{{ $d->id }}</td>
            <td>{{ $d->food }}</td>
            <td>{{ $d->qty }}</td>
            <td>{{ $d->price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $address->name}} - name <br>
{{ $address->street}} - street <br>
{{ $address->mobile}} - mobile <br>
{{ $address->instruction}} - instruction <br> <br> <br>

{{ $order->total_price }} - total_price <br>
{{ $order->delivery_fee }} - delivery_fee <br>
{{ $order->gst_percentage }} - gst_percentage
