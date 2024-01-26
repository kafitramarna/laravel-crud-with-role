@include('partials.header')
<div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Semester</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswa as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->nim}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->prodi}}</td>
                <td>{{$item->semester}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('partials.footer')