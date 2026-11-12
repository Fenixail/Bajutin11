document.addEventListener("DOMContentLoaded", () => {
  const body = document.querySelector('body');
  const modeSwitch = document.querySelector(".toggle-switch");
  const modeText = document.querySelector(".mode-text");

  // Проверка состояния темы при загрузке страницы
  if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark');
    if (modeText) {
      modeText.innerText = "Light mode"; // Обновите текст кнопки
    }
  }

  if (modeSwitch) {
    modeSwitch.addEventListener("click", () => {
      body.classList.toggle("dark");

      // Сохраните состояние темы в localStorage
      if (body.classList.contains("dark")) {
        if (modeText) {
          modeText.innerText = "Light mode";
        }
        localStorage.setItem('theme', 'dark'); // Сохраните тему
      } else {
        if (modeText) {
          modeText.innerText = "Dark mode";
        }
        localStorage.setItem('theme', 'light'); // Сохраните тему
      }
    });
  }
});
