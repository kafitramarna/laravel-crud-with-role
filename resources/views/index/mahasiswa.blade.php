@include ('partials/header')
@include ('partials/navbar')
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
                <td>1</td>
                <td>{{$item->nama_mahasiswa}}</td>
                <td>{{$item->prodi}}</td>
                <td>{{$item->jadwal_mulai_magang}}</td>
                <td>{{$item->jadwal_selesai_magang}}</td>
                <td>{{$item->nama_dosen}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include ('partials/footer')
