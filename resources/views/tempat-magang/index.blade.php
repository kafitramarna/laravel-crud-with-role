@include('partials.header')
@include('partials.navbar')
<h1>Data Tempat Magang</h1>
<a href="{{ route('tempat-magang.create') }}">Tambah Tempat Magang</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tempat</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Provinsi</th>
            <th>Telepon</th>
            <th>Action</th>
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
                <td>
                    <a href="{{ route('tempat-magang.edit', $item->id) }}" class="btn btn-primary">edit</a>
                    <form action="{{ route('tempat-magang.delete', $item->id) }}" method="post" onsubmit="return confirm('Yakin bang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('tempat-magang.print') }}">download pdf</a>
@include ('partials.footer')
