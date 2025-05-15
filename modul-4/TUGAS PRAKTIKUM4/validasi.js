document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");
  const emailInput = form.querySelector('input[type="email"]');
  const namaInput = form.querySelector('input[type="text"]');
  const passwordInput = form.querySelector('input[type="password"]');

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    let isValid = true;
    let email = emailInput.value.trim();
    let nama = namaInput.value.trim();
    let password = passwordInput.value.trim();

    if (!email) {
      alert("Email tidak boleh kosong");
      isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      alert("Format email tidak valid.");
      isValid = false;
    }

    if (!nama) {
      alert("Nama lengkap harus diisi.");
      isValid = false;
    }

    if (!password) {
      alert("Password harus diisi.");
      isValid = false;
    } else if (password.length < 8) {
      alert("Password minimal 8 karakter.");
      isValid = false;
    }

    if (isValid) {
      alert("Form berhasil dikirim!");
      form.submit();
    }
  });
});