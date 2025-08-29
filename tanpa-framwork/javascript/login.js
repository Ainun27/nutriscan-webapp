let isLogin = false;

function register() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!isLogin) {
        // Simpan data pengguna ke localStorage
        localStorage.setItem('userProfile', JSON.stringify({ name, email, password }));
        alert('Akun berhasil dibuat! Silakan masuk.');
        showLogin();
    } else {
        // Proses login
        const storedProfile = JSON.parse(localStorage.getItem('userProfile'));
        if (storedProfile && storedProfile.email === email && storedProfile.password === password) {
            alert(`Selamat datang, ${storedProfile.name}!`);
            window.location.href = 'dashboard.html'; // Ganti ini dengan halaman beranda
        } else {
            alert('Email atau kata sandi salah!');
        }
    }
}

function showLogin() {
    isLogin = true;
    document.getElementById('formTitle').innerText = 'Masuk';
    document.getElementById('submitButton').innerText = 'Masuk';
    document.getElementById('name').style.display = 'none';
}

function showRegister() {
    isLogin = false;
    document.getElementById('formTitle').innerText = 'Daftar';
    document.getElementById('submitButton').innerText = 'Daftar';
    document.getElementById('name').style.display = 'block';
}
