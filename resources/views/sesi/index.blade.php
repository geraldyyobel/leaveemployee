@extends('layoutlogin/aplikasi')

@section('konten')
<body>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <div class="container" id="container" style="background-image: url(assets/image/image.gif)">
    <div class="form-container register-container">
        <form action="/sesi/create" method="POST">
           @csrf
            <h1>Registrasi Akun</h1>
              {{-- <input type="text" placeholder="Name"> --}}
            <input type="text" name="name" placeholder="Nama Lengkap">
            <input type="text" name="id_karyawan" placeholder="ID Karyawan">
            <input type="username" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button name="submit" type="submit">Daftar Cuti</button>    
      </form>
    </div>
    @endsection
    @section('konten1')
    <div class="form-container login-container">
      <form action="{{ route('postlogin') }}" method="POST">
        @csrf
        <h1>Login</h1>
        <div class="form-group">
          <input type="username" value="{{ old('username') }}" name="username"
            class="@error('username') is-invalid @enderror"
            placeholder="Masukkan username">
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
        <input type="password" name="password" value="{{ old('password') }}"
            class="@error('password') is-invalid @enderror"
            placeholder="Masukkan Password">
          @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
          </div>
        {{-- <div class="content">
          <div class="checkbox">
            <input type="checkbox" name="checkbox" id="checkbox">
            <label>Remember me</label>
          </div>
          <div class="pass-link">
            <a href="#">Forgot password?</a>
          </div>
        </div> --}}
        <button type="submit">Login</button>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="title">Selamat Datang </h1>
          <h3 class="title"> Di Sistem Pengajuan Cuti Karyawan</h3>
          <p>Cuti bukanlah alasan untuk tidak Bekerja</p><p>Tetap Semangat Bekerja</p>
          <button class="ghost" id="login">Login<i class="lni lni-arrow-left login"></i></button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="title">Selamat Datang </h1>
          <h3 class="title"> Di Sistem Pengajuan Cuti Karyawan</h3>
          <p>Jika anda belum memiliki akun, silahkan daftar terlebih dahulu.</p>
          <button class="ghost" id="register">Register<i class="lni lni-arrow-right register"></i></button>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('assets/js/script.js')}}"></script>
  @endsection
</body>