function register(event) {
    event.preventDefault(); // Mencegah reload halaman
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Simpan data pengguna ke localStorage
    localStorage.setItem('userProfile', JSON.stringify({ name, email, password }));
    alert('Akun berhasil dibuat! Silakan masuk.');
    window.location.href = 'login.html';
}

function login(event) {
    event.preventDefault(); // Mencegah reload halaman
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const storedProfile = JSON.parse(localStorage.getItem('userProfile'));
    if (storedProfile && storedProfile.email === email && storedProfile.password === password) {
        alert(`Selamat datang, ${storedProfile.name}!`);
        window.location.href = 'dashboard.html'; // Ganti ini dengan halaman beranda
    } else {
        alert('Email atau kata sandi salah!');
    }
}
