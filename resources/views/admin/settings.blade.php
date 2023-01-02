

<table style="border-collapse: separate">
    <thead>
        <tr>
            <th>delivery_fee</th>
            <th>gst_percentage</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $setting->delivery_fee }}</td>
            <td>{{ $setting->gst_percentage }}</td>
            <td>{{ $setting->updated_at }}</td>
        </tr>
    </tbody>
</table>
<a href="{{ route('admin.settings.show') }}">edit</a>