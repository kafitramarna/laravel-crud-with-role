@include('partials.header')
<div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>Jadwal Magang</th>
                <th>Tempat Magang</th>
                <th>Dosen Pembimbing</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal_magang as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_mahasiswa }}</td>
                    <td>{{ $item->prodi }}</td>
                    <td>{{ date('d-F-Y', strtotime($item->jadwal_mulai_magang)) }} -
                        {{ date('d-F-Y', strtotime($item->jadwal_selesai_magang)) }}</td>
                    <td>{{ $item->nama_tempat }}</td>
                    <td>{{ $item->gelar_depan }} {{ $item->nama_dosen }} {{ $item->gelar_belakang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')
