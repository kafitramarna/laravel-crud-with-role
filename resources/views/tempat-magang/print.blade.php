@include('partials.header')
<div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tempat</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Provinsi</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tempat_magang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_tempat }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->kota }}</td>
                    <td>{{ $item->provinsi }}</td>
                    <td>{{ $item->telepon }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')