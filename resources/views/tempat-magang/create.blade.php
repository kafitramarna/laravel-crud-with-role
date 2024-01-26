@include ('partials.header')
<div>
    <form action="{{ route('tempat-magang.store') }}" method="post">
        @csrf
        <div>
            <label>Nama Tempat</label>
            <input type="text" name="nama_tempat">
            @error('nama_tempat')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Alamat</label>
            <input type="text" name="alamat">
            @error('alamat')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Kota</label>
            <input type="text" name="kota">
            @error('kota')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Provinsi</label>
            <input type="text" name="provinsi">
            @error('provinsi')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">Telepon</label>
            <input type="text" name="telepon">
            @error('telepon')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
</div>
@include ('partials.footer')
