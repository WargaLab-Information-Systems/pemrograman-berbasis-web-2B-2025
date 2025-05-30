document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const themeText = document.getElementById('theme-text');
    const html = document.documentElement;

    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  
    function applyTheme(theme) {
      if (theme === 'dark') {
        html.classList.add('dark');
        themeText.textContent = '☀️ Light Mode';
      } else {
        html.classList.remove('dark');
        themeText.textContent = '🌙 Dark Mode';
      }
    }

    if (savedTheme) {
      applyTheme(savedTheme);
    } else {
      applyTheme(systemPrefersDark ? 'dark' : 'light');
    }

    themeToggle.addEventListener('click', function () {
      const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      localStorage.setItem('theme', newTheme);
      applyTheme(newTheme);
    });

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
      const manualPreference = localStorage.getItem('theme');
      if (!manualPreference) {
        applyTheme(e.matches ? 'dark' : 'light');
      }
    });
  });
  