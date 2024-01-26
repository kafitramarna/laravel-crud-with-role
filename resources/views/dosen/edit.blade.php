@include('partials.header')
    <form action="{{route('dosen.update', $data->id)}}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label>NIK</label>
            <input type="text" name="nik" value="{{ $data->nik }}">
            @error ('nik')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Nama</label>
            <input type="text" name="nama" value="{{ $data->nama }}">
            @error ('nama')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Gelar Depan</label>
            <input type="text" name="gelar_depan" value="{{ $data->gelar_depan }}">
        </div>
        <div>
            <label for="">Gelar Belakang</label>
            <input type="text" name="gelar_belakang" value="{{ $data->gelar_belakang }}">
            @error ('gelar_belakang')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Prodi</label>
            <select name="prodi" id="">
                @foreach ($prodi as $item)
                <option value="{{$item->id}}" {{ $data->prodi == $item->id ? 'selected' : '' }}>{{$item->prodi}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
@include ('partials.footer')