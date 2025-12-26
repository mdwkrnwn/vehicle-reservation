<table>
    <thead>
        <tr>
            <th>Kode Booking</th>
            <th>Kendaraan</th>
            <th>Driver</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->code_booking }}</td>
                <td>{{ $booking->vehicle->merk ?? '-' }}</td>
                <td>{{ $booking->driver->nama ?? '-' }}</td>
                <td>{{ $booking->tanggal_mulai }}</td>
                <td>{{ $booking->tanggal_selesai }}</td>
                <td>
                    {{ optional($booking->approvals->last())->status ?? '-' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
