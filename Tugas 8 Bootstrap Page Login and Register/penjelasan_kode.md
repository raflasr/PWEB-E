### Bagian 1: Struktur Dasar HTML
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
```
- **DOCTYPE dan HTML**: Deklarasi tipe dokumen HTML dan penanda awal dokumen HTML.
- **Meta Charset**: Mengatur karakter encoding dokumen ke UTF-8.
- **Viewport**: Mengatur skala halaman agar sesuai dengan ukuran perangkat pengguna.
- **Bootstrap CSS**: Mengimpor pustaka Bootstrap versi 5.3.0 untuk memudahkan styling.

### Bagian 2: Styling Kustom
```html
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url('https://source.unsplash.com/1600x900/?nature');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .form-container {
        max-width: 500px;
        background-color: rgba(255, 255, 255, 0.85);
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(5px);
    }
    .nav-pills .nav-link.active {
        background-color: #007bff;
        color: white;
    }
    .form-label {
        font-weight: 600;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
</style>
```
- **Body**: Memusatkan konten di tengah layar dengan latar belakang gambar yang disetel untuk mencakup seluruh area.
- **Form Container**: Memberikan gaya pada form, termasuk lebar maksimum, warna transparan, efek bayangan, padding, dan radius.
- **Nav Pills dan Active Link**: Mengatur gaya tombol tab navigasi aktif pada tampilan login/register.
- **Form Label dan Button**: Mengatur font label dan warna tombol untuk tampilan yang konsisten dan menarik.

### Bagian 3: Struktur Utama Halaman
```html
<body>
    <div class="container form-container">
        <h3 class="text-center mb-4">Welcome Back</h3>
        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Login</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register" aria-selected="false">Register</button>
            </li>
        </ul>
```
- **Body dan Container**: Membungkus form dalam container terpusat dengan gaya yang diterapkan dari CSS.
- **Heading**: Menyediakan judul "Welcome Back" di atas form.
- **Navigasi Pills**: Menggunakan tab Bootstrap Pills untuk membuat dua opsi form (Login dan Register), memungkinkan pengguna beralih antara form login dan registrasi.

### Bagian 4: Form Login
```html
<div class="tab-content" id="pills-tabContent">
    <!-- Login Form -->
    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
        <form>
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="loginEmail" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
            <div class="text-center">
                <small><a href="#" class="text-muted">Forgot your password?</a></small>
            </div>
        </form>
    </div>
```
- **Form Login**: Ditampilkan ketika tab login dipilih. Terdiri dari dua input untuk email dan password, serta tombol submit untuk login.
- **Tautan Lupa Kata Sandi**: Menambahkan tautan untuk "Forgot your password?" sebagai opsi pemulihan kata sandi.

### Bagian 5: Form Registrasi
```html
    <!-- Register Form -->
    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
        <form>
            <div class="mb-3">
                <label for="registerName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="registerName" placeholder="Enter your full name">
            </div>
            <div class="mb-3">
                <label for="registerEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="registerEmail" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="registerPhone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="registerPhone" placeholder="Enter phone number">
            </div>
            <div class="mb-3">
                <label for="registerDOB" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="registerDOB">
            </div>
            <div class="mb-3">
                <label for="registerGender" class="form-label">Gender</label>
                <select class="form-select" id="registerGender">
                    <option selected disabled>Select your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="registerPassword" placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="registerConfirmPassword" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
    </div>
</div>
</div>
```
- **Form Registrasi**: Ditampilkan saat tab register dipilih. Mencakup beberapa kolom input tambahan seperti:
  - **Full Name**: Nama lengkap pengguna.
  - **Email**: Alamat email.
  - **Phone Number**: Nomor telepon.
  - **Date of Birth**: Tanggal lahir pengguna.
  - **Gender**: Dropdown untuk memilih jenis kelamin.
  - **Password dan Confirm Password**: Mengamankan akun pengguna.

### Bagian 6: Skrip Bootstrap
```html
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
- **Bootstrap JS**: Skrip JavaScript untuk Bootstrap yang mendukung komponen dinamis seperti tab, sehingga pengguna dapat beralih antara form login dan register.
