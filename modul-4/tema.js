// Inisialisasi Elemen dan Variabel
document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggle-theme");
  const html = document.documentElement;

// Cek tema tersimpan di localStorage
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme === "dark") {
    html.classList.add("dark");
    toggleButton.textContent = "☀️";
  } else {
    html.classList.remove("dark");
    toggleButton.textContent = "🌙";
  }

// Event toggle tema
  toggleButton.addEventListener("click", function () {
    if (html.classList.contains("dark")) {
      html.classList.remove("dark");
      localStorage.setItem("theme", "light");
      toggleButton.textContent = "🌙";
    } else {
      html.classList.add("dark");
      localStorage.setItem("theme", "dark");
      toggleButton.textContent = "☀️";
    }
  });
});
