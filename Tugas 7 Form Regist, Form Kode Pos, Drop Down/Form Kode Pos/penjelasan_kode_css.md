Kode yang Anda berikan adalah CSS yang digunakan untuk mendesain dan mengatur gaya elemen-elemen HTML pada halaman web. Mari kita bahas bagian-bagian kode ini secara detail.

### Penggunaan Variabel CSS
```css
:root {
    --background: rgba(242, 242, 242, 1);
    --container-background: white;
    --button-background: rgba(32, 191, 212, 0.5);
    --button-background-hover: rgba(32, 191, 212, 1);
    --text: black;
    --shadow: rgba(0, 0, 0, 0.05);
    --shadow-medium: rgba(0, 0, 0, 0.1);
}
```
- **`:root`**: Selector ini merepresentasikan elemen root dari dokumen (biasanya adalah elemen `<html>`). Variabel CSS didefinisikan di sini untuk digunakan di seluruh stylesheet.
- **Variabel**: Menggunakan variabel dengan format `--nama_variabel`, memungkinkan penggunaan nilai yang konsisten di berbagai tempat dalam stylesheet. Contohnya, warna latar belakang, warna teks, dan efek bayangan.

### Gaya Global
```css
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    color: var(--text);
}
```
- **`*`**: Selector universal yang menetapkan margin dan padding menjadi 0 untuk semua elemen, dan mengubah model box ke `border-box` (memastikan padding dan border tidak menambah lebar dan tinggi elemen).
- **`font-family` dan `color`**: Mengatur font default untuk seluruh halaman dan warna teks berdasarkan variabel yang telah didefinisikan.

### Gaya Body dan Elemen Heading
```css
body {
    background-color: var(--background);
}

label {
    display: block;
}

h1, h2 {
    font-family: 'Raleway', sans-serif;
    font-weight: bolder;
}

h1, h2, p {
    margin-bottom: 15px;
}
```
- **`body`**: Menetapkan warna latar belakang untuk seluruh halaman.
- **`label`**: Mengubah label menjadi blok, sehingga setiap label berada pada baris terpisah.
- **`h1` dan `h2`**: Mengatur font dan berat font untuk elemen heading, serta memberikan margin bawah untuk ruang antara elemen.

### Gaya untuk Elemen Input
```css
input {
    padding: 1px 3px;
}
```
- Memberikan padding pada elemen input untuk memberikan sedikit ruang di dalam elemen.

### Gaya Kontainer Utama
```css
#container {
    margin: 30px 60px;
}

.main-container, #search_result {
    max-width: 1080px;
    margin: 25px auto;
}

.main-container {
    background-color: var(--container-background);
    padding: 50px;
    border-radius: 1em;
    box-shadow: 0px 15px 80px 20px var(--shadow);
}
```
- **`#container`**: Memberikan margin pada kontainer utama.
- **`max-width`**: Mengatur lebar maksimum untuk kontainer utama dan hasil pencarian, dan pusatkan dengan `margin: auto`.
- **`box-shadow`**: Menambahkan bayangan pada kontainer utama untuk memberikan efek kedalaman.

### Gaya Tabel dan Tombol
```css
.table-row {
    display: table-row;
}

.table-cell {
    display: table-cell;
    margin-bottom: 7px;
    padding-right: 18px;
}

.table {
    margin-bottom: 15px;
}

.button {
    padding: 8px 15px;
    background-color: var(--button-background);
    border-radius: 8px;
    border-style: none;
    transition: 0.15s;
}

.button:hover {
    background-color: var(--button-background-hover);
    color: var(--container-background);
    cursor: pointer;
}
```
- **Tabel**: Menggunakan properti `display: table-row` dan `display: table-cell` untuk mengatur gaya baris dan sel tabel.
- **Tombol**: Mengatur gaya untuk tombol dengan padding, warna latar belakang, dan efek transisi saat dihover.

### Gaya Kontainer Hasil Pencarian
```css
#search_card_container {
    display: flex;
    flex-wrap: wrap;
    column-gap: 30px;
}

.search_card {
    width: 270px;
    padding: 15px;
    border-radius: 8px;
    background-color: var(--button-background);
    margin-bottom: 30px;
    transition: 0.2s;
}

.search_card p {
    margin-bottom: 10px;
}

.search_card:hover {
    box-shadow: 0px 15px 70px 15px var(--shadow-medium);
    transform: scale(1.05, 1.05);
}
```
- **`#search_card_container`**: Menggunakan Flexbox untuk mengatur hasil pencarian dengan mengizinkan pembungkusan baris.
- **`.search_card`**: Mengatur gaya untuk setiap kartu hasil pencarian, termasuk lebar, padding, warna latar belakang, dan efek transisi.
- **Hover pada Kartu**: Menambahkan efek bayangan dan skala saat kartu hasil pencarian dihover untuk menarik perhatian pengguna.

### Media Queries
```css
@media only screen and (max-width: 600px) {
    #container {
        margin: 30px;
    }
    .table-cell {
        display: block;   
        margin-bottom: 5px;
    }
    .main-container {
        padding: 30px;
    }
}
```
- **Media Queries**: Mengatur gaya untuk perangkat dengan lebar maksimum 600px (umumnya ponsel). Mengubah tampilan elemen menjadi lebih responsif dengan mengubah `table-cell` menjadi blok dan mengurangi padding di kontainer utama.
