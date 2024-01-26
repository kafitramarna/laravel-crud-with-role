@include('partials.header')
<div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Gelar Depan</th>
                <th>Gelar Belakang</th>
                <th>Program Studi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dosen as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->gelar_depan }}</td>
                    <td>{{ $item->gelar_belakang }}</td>
                    <td>{{ $item->prodi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')