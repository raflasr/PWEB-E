Berikut adalah penjelasan dari kode JavaScript yang Anda berikan:

### Struktur Kode

1. **Definisi Produk dan Merek**:
   ```javascript
   const products = {
       Desktop: ["Dell", "HP", "Lenovo"],
       Laptop: ["Apple", "Asus", "Acer"],
       Smartphone: ["Samsung", "Xiaomi", "Oppo"]
   };
   ```
   - Kode ini mendefinisikan sebuah objek `products` yang berisi kategori produk (Desktop, Laptop, Smartphone) sebagai kunci.
   - Setiap kunci memiliki nilai berupa array yang berisi merek-merek yang sesuai untuk kategori tersebut. Misalnya, untuk `Desktop`, ada merek `Dell`, `HP`, dan `Lenovo`.

2. **Fungsi `updateBrands`**:
   ```javascript
   function updateBrands() {
       const productType = document.getElementById('product-type').value;
       const brandDropdown = document.getElementById('brand');
   ```
   - Fungsi ini akan dipanggil setiap kali pengguna mengubah pilihan di dropdown jenis produk.
   - `const productType`: Mendapatkan nilai yang dipilih dari dropdown `product-type`.
   - `const brandDropdown`: Mendapatkan referensi ke dropdown `brand`.

3. **Menghapus Opsi Saat Ini**:
   ```javascript
   brandDropdown.innerHTML = '<option value="">Pilih Merk</option>';
   ```
   - Sebelum menambahkan merek baru, kode ini menghapus semua opsi yang ada di dropdown `brand` dengan menetapkan HTML-nya kembali ke opsi default ("Pilih Merk").

4. **Menambahkan Opsi Baru**:
   ```javascript
   if (productType) {
       const brands = products[productType];

       // Add new options dynamically
       brands.forEach(brand => {
           const option = document.createElement('option');
           option.value = brand;
           option.text = brand;
           brandDropdown.add(option);
       });
   }
   ```
   - **Memeriksa Apakah Ada Jenis Produk yang Dipilih**:
     - Jika ada jenis produk yang dipilih (yaitu, `productType` tidak kosong), kode akan melanjutkan untuk mengambil merek yang sesuai dari objek `products` berdasarkan `productType`.
   - **Menambahkan Opsi**:
     - Menggunakan metode `forEach` untuk iterasi melalui setiap merek dalam array `brands`.
     - Untuk setiap merek, kode:
       - Membuat elemen `<option>` baru.
       - Mengatur atribut `value` dan teks dari opsi dengan nama merek.
       - Menambahkan opsi tersebut ke dropdown `brand` menggunakan metode `add()`.
