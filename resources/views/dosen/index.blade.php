@include ('partials.header')
@include ('partials.navbar')
<h1>Data Dosen</h1>
<form action="{{ route('dosen.index') }}" method="GET">
    <div>
        <label for="">Cari berdasarkan nama atau nik</label>
        <input type="text" name="search" id="search" placeholder="nama / nik">
    </div>
    <button type="submit">Cari</button>
</form>
<a href="{{ route('dosen.create') }}">Tambah Dosen</a>
@if ($dosen->count() > 0)
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Gelar Depan</th>
            <th>Gelar Belakang</th>
            <th>Program Studi</th>
            <th>Action</th>
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
                <td>
                    <a href="{{ route('dosen.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('dosen.delete', $item->id) }}" method="post" onsubmit="return confirm('Yakin bang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dosen.print') }}">download pdf</a>
{{$dosen->links()}}
@else
    <p>Tidak ada data</p>
@endif
@include ('partials.footer')
