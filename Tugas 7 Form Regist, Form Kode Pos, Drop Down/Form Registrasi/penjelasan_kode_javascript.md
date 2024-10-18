Berikut adalah penjelasan dari kode JavaScript yang Anda berikan, yang berfungsi untuk menangani fitur autocompletion pada input nama mahasiswa dan validasi email dalam formulir registrasi:

### Struktur Kode

1. **Daftar Nama Mahasiswa**:
   ```javascript
   const namaMahasiswa = ["Ahmad Sulaiman", "Budi Santoso", "Citra Dewi", "Dian Lestari", "Eka Putra", "Fatimah Nur", "Gilang Ramadhan"];
   ```
   - Kode ini mendefinisikan sebuah array `namaMahasiswa` yang berisi daftar nama mahasiswa. Nama-nama ini akan digunakan untuk memberikan saran saat pengguna mengetik di input nama.

2. **Elemen Input dan Kontainer Saran**:
   ```javascript
   const namaInput = document.getElementById('nama');
   const suggestionsContainer = document.getElementById('namaSuggestions');
   const emailInput = document.getElementById('email');
   const emailError = document.getElementById('emailError');
   const form = document.getElementById('formRegistrasi');
   ```
   - Mengambil referensi elemen-elemen DOM dari halaman HTML:
     - `namaInput`: Elemen input untuk nama mahasiswa.
     - `suggestionsContainer`: Div untuk menampilkan saran nama.
     - `emailInput`: Elemen input untuk email.
     - `emailError`: Elemen yang menampilkan pesan kesalahan untuk email.
     - `form`: Elemen form untuk registrasi.

3. **Fungsi untuk Menampilkan Saran**:
   ```javascript
   function showSuggestions(value) {
       suggestionsContainer.innerHTML = '';
       if (value.length === 0) return;

       const filteredNames = namaMahasiswa.filter(nama => 
           nama.toLowerCase().includes(value.toLowerCase())
       );

       filteredNames.forEach(nama => {
           const suggestionDiv = document.createElement('div');
           suggestionDiv.textContent = nama;
           suggestionDiv.addEventListener('click', () => {
               namaInput.value = nama;
               suggestionsContainer.innerHTML = '';
           });
           suggestionsContainer.appendChild(suggestionDiv);
       });
   }
   ```
   - **Membersihkan Saran Sebelumnya**: Mengosongkan `suggestionsContainer` setiap kali fungsi dipanggil.
   - **Menghentikan Eksekusi**: Jika `value` (teks yang diketik) kosong, fungsi akan berhenti.
   - **Menyaring Nama**: Menggunakan `filter()` untuk mencari nama yang mengandung teks yang diketik (tidak case-sensitive).
   - **Menampilkan Saran**: Untuk setiap nama yang cocok, fungsi:
     - Membuat elemen `div` baru untuk menampilkan saran.
     - Menambahkan event listener untuk mengisi input dengan nama yang diklik dan mengosongkan kontainer saran.
     - Menambahkan elemen saran ke dalam `suggestionsContainer`.

4. **Event Listener untuk Input Nama Mahasiswa**:
   ```javascript
   namaInput.addEventListener('input', (e) => {
       showSuggestions(e.target.value);
   });
   ```
   - Ketika pengguna mengetik di input `nama`, event listener akan memanggil fungsi `showSuggestions` dan meneruskan nilai yang diketik ke fungsi tersebut.

5. **Event Listener untuk Menghilangkan Saran Saat Input Kehilangan Fokus**:
   ```javascript
   namaInput.addEventListener('blur', () => {
       setTimeout(() => {
           suggestionsContainer.innerHTML = '';
       }, 100); // Delay untuk memberikan waktu pada klik saran
   });
   ```
   - Ketika input kehilangan fokus (blur), fungsi ini akan menghapus saran setelah penundaan 100 ms. Penundaan ini memberikan waktu bagi pengguna untuk mengklik salah satu saran.

6. **Validasi Email**:
   ```javascript
   form.addEventListener('submit', (e) => {
       if (emailInput.value === '') {
           e.preventDefault(); // Mencegah form dikirim
           emailError.style.display = 'block'; // Tampilkan pesan error
       } else {
           emailError.style.display = 'none'; // Sembunyikan pesan error
       }
   });
   ```
   - Menambahkan event listener pada form untuk menangani pengiriman:
     - Jika input email kosong saat formulir disubmit, `preventDefault()` digunakan untuk mencegah pengiriman form, dan pesan kesalahan ditampilkan.
     - Jika email terisi, pesan kesalahan disembunyikan.
