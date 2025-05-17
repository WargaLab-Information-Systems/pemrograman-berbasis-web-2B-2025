// Inisialisasi Elemen dan Variabel
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("signupForm");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Ambil input
    const email = document.getElementById("email");
    const name = document.getElementById("name");
    const password = document.getElementById("password");

    let isValid = true;

    // Reset semua pesan error
    document.querySelectorAll(".error-message").forEach(el => el.textContent = "");

    // Validasi email
    if (!email.value.trim()) {
      showError(email, "Email tidak boleh kosong.");
      isValid = false;
    } else if (!validateEmail(email.value)) {
      showError(email, "Format email tidak valid.");
      isValid = false;
    }

    // Validasi nama
    if (!name.value.trim()) {
      showError(name, "Nama lengkap wajib diisi.");
      isValid = false;
    }

    // Validasi password
    if (!password.value.trim()) {
      showError(password, "Password tidak boleh kosong.");
      isValid = false;
    } else if (password.value.length < 6) {
      showError(password, "Password minimal 6 karakter.");
      isValid = false;
    }

    // Jika valid
    if (isValid) {
      alert("Pendaftaran berhasil!");
      form.reset();
    }
  });

  function showError(input, message) {
    const errorElem = input.nextElementSibling;
    if (errorElem) errorElem.textContent = message;
  }

  function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }
});
