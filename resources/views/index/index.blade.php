@include ('partials.header')
@include ('partials.navbar')
<h1>Jadwal Magang</h1>
<a href="{{ route('dashboard.create') }}">Tambah Jadwal Magang</a>
<div>
    <form action="{{ route('dashboard.index') }}" method="get">
        <div>
            <label for="">Filter Berdasarkan Prodi</label>
            <select name="prodi" id="">
                <option value="">Pilih Prodi</option>
                @foreach ($prodi as $item)
                    <option value="{{ $item->id }}" {{ request('prodi') == $item->id ? 'selected' : '' }}>{{ $item->prodi }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Filter Berdasarkan Tempat Magang</label>
            <select name="tempat_magang" id="">
                <option value="">Pilih Tempat Magang</option>
                @foreach ($tempat_magang as $item)
                    <option value="{{ $item->id }}" {{ request('tempat_magang') == $item->id ? 'selected' : '' }}>{{ $item->nama_tempat }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Filter Berdasarkan Dosen Pembimbing</label>
            <select name="dosen" id="">
                <option value="">Pilih Dosen</option>
                @foreach ($dosen as $item)
                    <option value="{{ $item->id }}" {{ request('dosen') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Filter Berdasarkan tanggal mulai magang</label>
            <input type="date" name="jadwal_mulai_magang" value="{{ request('jadwal_mulai_magang') }}">
        </div>
        <div>
            <label for="">Filter Berdasarkan tanggal selesai magang</label>
            <input type="date" name="jadwal_selesai_magang" value="{{ request('jadwal_selesai_magang') }}">
        </div>
        <button type="submit">Filter</button>
    </form>
</div>
@if($jadwal_magang->count() > 0)
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>Program Studi</th>
            <th>Jadwal Magang</th>
            <th>Tempat Magang</th>
            <th>Dosen Pembimbing</th>
            <th>Action</th>
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
                <td>
                    <a href="{{ route('dashboard.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('dashboard.delete', $item->id) }}" method="post"
                        onsubmit="return confirm('Yakin bang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('dashboard.print') }}">download pdf</a>
{{$jadwal_magang->links()}}
@else
    <p>Tidak ada data</p>
@endif
@include ('partials.footer')
