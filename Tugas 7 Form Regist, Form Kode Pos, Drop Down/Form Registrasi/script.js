// Daftar nama mahasiswa untuk rekomendasi
const namaMahasiswa = ["Ahmad Sulaiman", "Budi Santoso", "Citra Dewi", "Dian Lestari", "Eka Putra", "Fatimah Nur", "Gilang Ramadhan"];

// Elemen input nama mahasiswa
const namaInput = document.getElementById('nama');
const suggestionsContainer = document.getElementById('namaSuggestions');
const emailInput = document.getElementById('email');
const emailError = document.getElementById('emailError');
const form = document.getElementById('formRegistrasi');

// Fungsi untuk menampilkan saran
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

// Event listener untuk input nama mahasiswa
namaInput.addEventListener('input', (e) => {
    showSuggestions(e.target.value);
});

// Event listener untuk menghilangkan saran saat input kehilangan fokus
namaInput.addEventListener('blur', () => {
    setTimeout(() => {
        suggestionsContainer.innerHTML = '';
    }, 100); // Delay untuk memberikan waktu pada klik saran
});

// Validasi email tidak boleh kosong
form.addEventListener('submit', (e) => {
    if (emailInput.value === '') {
        e.preventDefault(); // Mencegah form dikirim
        emailError.style.display = 'block'; // Tampilkan pesan error
    } else {
        emailError.style.display = 'none'; // Sembunyikan pesan error
    }
});
