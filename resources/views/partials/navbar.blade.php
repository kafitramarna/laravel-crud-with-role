<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('dashboard.index')}}">Jadwal Magang</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('mahasiswa.index')}}">Daftar Mahasiswa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('dosen.index')}}">Daftar Dosen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('tempat-magang.index')}}">Daftar Tempat Magang</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger" href="{{route('logout')}}" onclick="return confirm('Yakin Ingin Keluar?')">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>