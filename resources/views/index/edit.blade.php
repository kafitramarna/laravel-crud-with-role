@include('partials.header')
<div>
    <form action=" {{ route('dashboard.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="">Nama Mahasiswa :</label><p>{{ $mahasiswa->nama }}</p>
            <input type="hidden" name="id_mahasiswa" value="{{ $mahasiswa->id}}" readonly>
        </div>
        <div>
            <label for="">Pilih Jadwal Mulai Magang</label>
            <input type="date" name="jadwal_mulai_magang" id="" value="{{ $data->jadwal_mulai_magang }}">
            @error('jadwal_mulai_magang')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Jadwal Selesai Magang</label>
            <input type="date" name="jadwal_selesai_magang" id="" value="{{ $data->jadwal_selesai_magang }}">
            @error('jadwal_selesai_magang')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Dosen</label>
            <select name="id_dosen" id="">
                @foreach ($dosen as $item)
                    <option value="{{ $item->id }}" {{ $data->id_dosen == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
            </select>
            @error('id_dosen')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Tempat Magang</label>
            <select name="id_tempat_magang" id="">
                @foreach ($tempat_magang as $item)
                    <option value="{{ $item->id }}" {{ $data->id_tempat_magang == $item->id ? 'selected' : '' }}>{{ $item->nama_tempat }}</option>
                @endforeach
            </select>
            @error('id_tempat_magang')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
@include('partials.footer')
