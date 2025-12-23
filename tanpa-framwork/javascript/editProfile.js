// Memuat data pengguna dari localStorage saat halaman dibuka
window.onload = function() {
    const storedProfile = JSON.parse(localStorage.getItem('userProfile'));
    if (storedProfile) {
        document.getElementById('name').value = storedProfile.name;
        document.getElementById('email').value = storedProfile.email;
        document.getElementById('password').value = storedProfile.password || '';
    }
};

function saveProfile() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Simpan data pengguna yang diperbarui ke localStorage
    localStorage.setItem('userProfile', JSON.stringify({ name, email, password }));
    alert('Profil berhasil diperbarui!');

    // Arahkan kembali ke halaman profil
    window.location.href = "profile.html"; // Ganti dengan nama file halaman profil Anda
}
