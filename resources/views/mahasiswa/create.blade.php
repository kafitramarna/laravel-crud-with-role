@include ('partials.header')
    <form action="{{route('mahasiswa.store')}}" method="post">
        @csrf
        <div>
            <label>NIM</label>
            <input type="text" name="nim">
            @error ('nim')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Nama</label>
            <input type="text" name="nama">
            @error ('nama')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <div>
            <label for="">Pilih Prodi</label>
            <select name="prodi" id="">
                @foreach ($prodi as $item)
                <option value="{{$item->id}}">{{$item->prodi}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="">Semester</label>
            <input type="text" name="semester">
            @error ('semester')
                <p style="color:red">{{$message}}</p>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
@include('partials.footer')