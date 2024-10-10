PENJELASAN KODE HTML

1. Struktur dasar HTML
   - <!DOCTYPE html>: Menyatakan bahwa ini adalah dokumen HTML5.
   - <html lang="id">: Tag pembuka untuk dokumen HTML dengan atribut lang yang menunjukkan bahwa konten dalam bahasa Indonesia.
   - <head>: Bagian ini mengandung metadata, termasuk:
     - <meta charset="UTF-8">: Menentukan karakter encoding yang digunakan, yaitu UTF-8.
     - <meta name="viewport" content="width=device-width, initial-scale=1.0">: Mengatur tampilan responsif untuk perangkat mobile.
     - <title>: Judul halaman yang ditampilkan di tab browser.
     - <link rel="stylesheet" href="styles.css">: Menghubungkan file CSS eksternal untuk penataan (styling).
2. Bagian body
   - <body>: Bagian utama dari dokumen yang berisi konten yang ditampilkan.
   - <header>: Menyimpan judul utama dan navigasi.
     - <h1>: Judul utama halaman.
     - <nav>: Menyediakan navigasi utama dengan daftar tautan menggunakan <ul> (unordered list) dan <li> (list items).
3. Bagian utama (main)
   - <main>: Menyimpan konten utama halaman.
   - <section>: Mengorganisasi konten menjadi bagian-bagian yang berbeda, masing-masing dengan id unik untuk navigasi:
     - id="home": Menyambut pengunjung dengan deskripsi.
     - id="languages": Memperkenalkan bahasa-bahasa di dunia, di mana setiap bahasa dijelaskan dalam <div class="language">.
         - <h3>: Subjudul untuk setiap bahasa dengan tautan yang mengarah ke bagian tertentu di halaman.
         - <img>: Menampilkan gambar terkait dengan bahasa.
         - <p>: Deskripsi tentang bahasa tersebut, menggunakan kelas justify-text untuk merata-rata teks.
4. Bagian tentang dan sumber belajar
   - <section id="about">: Menyediakan informasi tentang manfaat belajar bahasa.
   - <section id="resources">: Mencantumkan berbagai sumber belajar, termasuk aplikasi, video, dan buku. Setiap sumber terdaftar dalam <ul> dengan <li> untuk masing-masing item, yang terdiri dari deskripsi dan gambar.
5. Bagian kontak dan footer
    - <section id="contact">: Menyediakan informasi kontak untuk pengunjung yang ingin berinteraksi atau bertanya.
    - <footer>: Menyediakan informasi hak cipta untuk halaman.

PENJELASAN KODE CSS

1. Global styles
   - font-family: Mengatur jenis font yang digunakan di halaman (Arial dan sans-serif).
   - background-color: Menetapkan warna latar belakang halaman menjadi abu-abu muda (#f4f4f4).
   - color: Menentukan warna teks menjadi abu-abu gelap (#333).
   - margin dan padding: Menghapus margin dan padding default pada elemen body.
3. Header styles
   - background-color: Menetapkan warna latar belakang header menjadi biru (#3498db).
   - color: Mengatur warna teks header menjadi putih.
   - padding: Memberikan ruang di dalam header.
   - text-align: Mengatur teks menjadi rata tengah.
5. Navigation styles
   - nav ul: Menghilangkan titik pada daftar dan padding default.
   - nav ul li: Mengatur item daftar menjadi baris dengan margin antar item.
   - nav ul li a: Mengatur warna tautan menjadi putih dan menghapus garis bawah.
   - transition: Menambahkan efek transisi halus untuk perubahan warna saat tautan dihover.
   - hover dan active: Mengubah warna tautan menjadi kuning (#ffcc00) saat dihover atau diklik.
7. Main content styles
   - main: Menambahkan padding di dalam elemen utama.
   - h2: Mengatur warna judul menjadi biru dan menambahkan garis bawah.
9. Image styles
   - width dan height: Mengatur ukuran gambar.
   - object-fit: Memastikan gambar tidak terdistorsi.
   - border-radius: Memberikan sudut melengkung pada gambar.
   - margin: Memberikan jarak vertikal antara gambar.
11. Language and resource list styles
   - .language-list: Mengatur daftar bahasa menjadi flexbox untuk tata letak yang responsif.
   - .language: Gaya untuk setiap elemen bahasa, termasuk latar belakang, batas, margin, padding, dan bayangan.
   - .resource-list: Menghilangkan titik pada daftar sumber dan padding.
   - .resource-list li: Menambahkan gaya serupa untuk elemen daftar sumber.
13. Resource item styles
   - .resource-item: Mengatur item sumber menjadi flexbox dengan penataan vertikal.
   - .resource-text: Memberikan lebih banyak ruang untuk teks dan memberikan jarak antara teks dan gambar.
   - .resource-image: Mengatur ukuran gambar dan memberikan sudut melengkung.
14. Text justification and link styles
   - .justify-text: Mengatur teks menjadi rata kiri dan kanan.
   - .language-link: Mengatur tautan agar mengikuti warna teks induk dan menghapus garis bawah.
   - .language-link:hover: Menambahkan garis bawah saat tautan dihover.
15. Footer styles
   - text-align: Mengatur teks footer menjadi rata tengah.
   - padding: Memberikan ruang di atas dan bawah teks footer.
   - background-color: Menetapkan warna latar belakang footer menjadi biru.
   - color: Mengatur warna teks footer menjadi putih.
   - position: Mengatur posisi relatif, memungkinkan penempatan footer di bagian bawah.
   - width: Mengatur lebar footer menjadi 100% dari elemen induk.
