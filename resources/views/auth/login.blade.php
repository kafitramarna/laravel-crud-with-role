@include ('partials.header')
<div>
    <form action="{{route('login-process')}}" method="POST">
        @csrf
        <div>
            <label for="">
                Masukkan Username :
            </label>
            <input type="text" name ="username" placeholder="username">
            @error('username')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="">
                Masukkan Password :
            </label>
            <input type="password" name ="password" placeholder="password">
            @error('password')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>
            @error('error')
                <p style="color:red">{{ $message }}</p>
            @enderror
            <button type="submit">Login</button>
    </form>
</div>
@include ('partials.footer')
