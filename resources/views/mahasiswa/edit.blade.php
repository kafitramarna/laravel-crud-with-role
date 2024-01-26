@include ('partials.header')
    <form action="{{route('mahasiswa.update', $data->id)}}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label>NIM</label>
            <input type="text" name="nim" value="{{ $data->nim }}">
            @error ('nim')
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
            <label for="">Pilih Prodi</label>
            <select name="prodi" id="">
                @foreach ($prodi as $item)
                <option value="{{$item->id}}" {{ $data->prodi == $item->id ? 'selected' : '' }}>{{$item->prodi}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Semester</label>
            <input type="text" name="semester" value="{{ $data->semester }}">
            @error ('semester')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
@include('partials.footer')