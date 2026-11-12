<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Созданные объявления</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
          <img src="logo.png" alt="">
        </span>

        <div class="text logo-text">
          <span class="name">Liderhouse</span>
          <span class="profession">Houses</span>
        </div>
      </div>

      <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
      <div class="menu">
        <ul class="menu-links">
          <li class="nav-link">
            <a href="Mainmenu.html">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Main menu</span>
            </a>
          </li>

          <ul class="nav-list">
            <li class="nav-link">
                <a href="Likes.html" class="likes">
                    <i class='bx bx-heart icon'></i>
                    <span class="text nav-text">Likes</span>
                </a>
            </li>

            <li class="nav-link">
              <a href="Recent.html">
                  <i class='bx bx-time icon'></i> 
                  <span class="text nav-text">Recent</span> 
              </a>
          </li>

        </li>
        <li class="nav-link">
            <a href="Create.html">
                <i class='bx bx-plus-circle icon'></i> 
                <span class="text nav-text">Create Announcement</span> 
            </a>
        </li>

        <li class="nav-link">
          <a href="Createhouse.php">
              <i class='bx bx-plus-circle icon'></i> 
              <span class="text nav-text">Savehouse</span> 
          </a>
      </li>
      

        </ul>
      </div>

      <div class="bottom-content">

        <li class="mode">
          <div class="sun-moon">
            <i class='bx bx-moon icon moon'></i>
            <i class='bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark mode</span>

          <div class="toggle-switch">
            <span class="switch"></span>
          </div>
        </li>
      </div>
    </div>
  </nav>

<section class="home">
    <div class="text">Список созданных объявлений</div>

    <div class="property-list">
        <?php
        // Подключение к базе данных
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "real_estate";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }

        // Получаем объявления
        $result = $conn->query("SELECT * FROM houses");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='property'>";
                echo "<a href='Houses/house" . $row['id'] . ".html'>";
                echo "<img src='" . $row['photo'] . "' alt='" . $row['house_name'] . "'>";
                echo "<div class='property-info'>";
                echo "<h3>" . $row['house_name'] . "</h3>";
                echo "<p>Location: " . $row['location'] . "</p>";
                echo "<p>Price: " . $row['price'] . " руб.</p>";
                echo "</div>";
                echo "</a>";
                echo "</div>"; // Закрываем контейнер для каждого объявления
            }
        } else {
            echo "<p>Объявлений нет.</p>";
        }

        $conn->close();
        ?>
    </div>
</section>

<script>
  // Получаем ссылки на необходимые элементы
  const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'), // Боковая панель навигации
        toggle = body.querySelector(".toggle"), // Кнопка переключения для боковой панели
        modeSwitch = body.querySelector(".toggle-switch"), // Переключатель режима
        modeText = body.querySelector(".mode-text"); // Текст режима

  // Проверка состояния темной темы из localStorage
  if (localStorage.getItem('darkMode') === 'enabled') {
      body.classList.add('dark'); // Добавляем темный класс
      modeText.innerText = "Light mode"; // Обновляем текст режима
  } else {
      modeText.innerText = "Dark mode"; // Устанавливаем текст по умолчанию
  }

  // Обработчик клика для кнопки toggler
  toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close"); // Переключаем класс close для боковой панели
  });

  // Обработчик клика для переключателя режима
  modeSwitch.addEventListener("click", () => {
      body.classList.toggle("dark"); // Переключаем класс dark

      // Сохранение состояния темы в localStorage
      if (body.classList.contains("dark")) {
          modeText.innerText = "Light mode"; // Обновляем текст для света
          localStorage.setItem('darkMode', 'enabled'); // Устанавливаем значение в localStorage
      } else {
          modeText.innerText = "Dark mode"; // Обновляем текст для темного режима
          localStorage.setItem('darkMode', 'disabled'); // Отключаем значение в localStorage
      }
  });
</script>


  <style>
    body.dark {
    background-color: #333; /* Фон для темного режима */
    color: #fff; /* Цвет текста для темного режима */
}

body {
    background-color: #fff; /* Фон для светлого режима */
    color: #000; /* Цвет текста для светлого режима */
}
.property a {
    text-decoration: none; /* Убрать подчеркивание */
    color: inherit; /* Установить цвет текста таким же, как текущий */
}

.property a:hover {
    opacity: 0.8; /* Эффект при наведении */
}
    .property-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px;
    }

    .property {
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: calc(33.333% - 20px); /* 3 дома в строке */
    }

    .property img {
      width: 100%;
      height: auto;
    }

    .property-info {
      padding: 15px;
    }

    .property-info h3 {
      margin: 0 0 10px;
      font-size: 18px;
      color: var(--text-color);
    }

    .property-info p {
      margin: 5px 0;
      color: #666;
    }
    
  </style>

</body>
</html>
