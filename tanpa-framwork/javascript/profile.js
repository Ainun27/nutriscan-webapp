 // Mengambil data profil dari local storage
const userProfile = JSON.parse(localStorage.getItem('userProfile'));
if (userProfile) {
    document.getElementById('profileName').textContent = userProfile.name;
    document.getElementById('profileEmail').textContent = userProfile.email;
} else {
    alert('Data profil tidak ditemukan. Silakan mendaftar terlebih dahulu.');
    window.location.href = 'login.html'; 
}