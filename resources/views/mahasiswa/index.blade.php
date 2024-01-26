@include ('partials.header')
@include ('partials.navbar')
    <h1>Data Mahasiswa</h1>
    <a href="{{route('mahasiswa.create')}}">Tambah Mahasiswa</a>
    <form action="{{route('mahasiswa.index')}}" method="GET">
        <div>
            <label for="">Cari berdasarkan Nama / NIM</label>
            <input type="text" name="search" id="search" placeholder="Nama / NIM">
        </div>
        <button type="submit">Cari</button>
    </form>
@if ($mahasiswa->count() > 0)
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Semester</th>
            <th>Action</th>
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
            <td>
                <a href="{{route('mahasiswa.edit', $item->id)}}" class="btn btn-primary">edit</a>
                <form action="{{route('mahasiswa.delete', $item->id)}}" method="post" onsubmit="return confirm('Yakin bang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{route('mahasiswa.print')}}">download pdf</a>
{{$mahasiswa->links()}}
@else
    <p>Tidak ada data</p>
@endif
@include ('partials/footer')