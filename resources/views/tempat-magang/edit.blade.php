@include ('partials.header')
<div>
    <form action="{{ route('tempat-magang.update', $data->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label>Nama Tempat</label>
            <input type="text" name="nama_tempat" value="{{ $data->nama_tempat }}">
            @error('nama_tempat')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Alamat</label>
            <input type="text" name="alamat" value="{{ $data->alamat }}">
            @error('alamat')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Kota</label>
            <input type="text" name="kota" value="{{ $data->kota }}">
            @error('kota')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Provinsi</label>
            <input type="text" name="provinsi" value="{{ $data->provinsi }}">
            @error('provinsi')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Telepon</label>
            <input type="text" name="telepon" value="{{ $data->telepon }}">
            @error('telepon')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
@include ('partials.footer')
