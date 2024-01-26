@include ('partials.header')
<div>
    <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf
        <div>
            <label for="">Pilih Mahasiswa</label>
            <select name="id_mahasiswa" id="">
                @foreach ($mahasiswa as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            @error ('id_mahasiswa')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Jadwal Mulai Magang</label>
            <input type="date" name="jadwal_mulai_magang" id="">
            @error ('jadwal_mulai_magang')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Jadwal Selesai Magang</label>
            <input type="date" name="jadwal_selesai_magang" id="">
            @error ('jadwal_selesai_magang')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Dosen</label>
            <select name="id_dosen" id="">
                @foreach ($dosen as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            @error ('id_dosen')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Tempat Magang</label>
            <select name="id_tempat_magang" id="">
                @foreach ($tempat_magang as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_tempat }}</option>
                @endforeach
            </select>
            @error ('id_tempat_magang')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
@include ('partials.footer')
