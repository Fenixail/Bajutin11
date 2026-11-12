<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liderhouse</title>
    <link rel="stylesheet" href="index1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    
    <header class="header">
        <h1>Добро пожаловать в Liderhouse</h1>
        <p>Ваш надежный партнер в мире недвижимости</p>
        <nav>
            <a href="index.php" class="btn">Авторизация</a>
        </nav>
    </header>

    <main class="main-content">
        <section class="intro">
            <h2>О нашем агентстве</h2>
            <p>
                Мы представляем собой агентство недвижимости, которое предлагает широкий выбор домов и квартир. Наша цель — упростить процесс покупки и аренды недвижимости, предоставляя нашим клиентам качественный сервис.
            </p>
        </section>

        <section class="features">
            <h2>Почему выбирают нас?</h2>
            <div class="feature">
                <i class='bx bx-home-alt'></i>
                <h3>Широкий выбор недвижимости</h3>
                <p>Мы предлагаем разнообразные варианты — от уютных квартир до роскошных домов.</p>
            </div>
            <div class="feature">
                <i class='bx bx-user'></i>
                <h3>Профессиональные агенты</h3>
                <p>Наша команда опытных агентов поможет вам на каждом этапе, обеспечивая индивидуальный подход.</p>
            </div>
            <div class="feature">
                <i class='bx bx-shield'></i>
                <h3>Безопасные сделки</h3>
                <p>Мы гарантируем законность и безопасность всех сделок, защитив ваши интересы.</p>
            </div>
        </section>

        <section class="process">
            <h2>Процесс взаимодействия</h2>
            <ol>
                <li><strong>Вступление:</strong> Свяжитесь с нами, чтобы обсудить ваши пожелания и требования.</li>
                <li><strong>Просмотр:</strong> Мы предоставим вам доступ к актуальным предложениям недвижимости.</li>
                <li><strong>Покупка:</strong> Поможем провести сделку максимально быстро и удобно.</li>
            </ol>
        </section>

        <section class="testimonials">
            <h2>Отзывы клиентов</h2>
            <div class="testimonial">
                <p>"Работа с Liderhouse была просто замечательной! Они сделали весь процесс покупки квартиры лёгким и приятным."</p>
                <cite>- Анна П.</cite>
            </div>
            <div class="testimonial">
                <p>"Я нашёл свою идеальную тему благодаря Liderhouse. Рекомендую всем!"</p>
                <cite>- Игорь Т.</cite>
            </div>
        </section>
    </main>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .links-block {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }
        .links-block h2 {
            text-align: center;
            color: #333;
            font-size: 24px; /* Увеличенный размер заголовка */
        }
        .social-links {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap; /* Позволяет ссылкам переноситься на следующую строку при необходимости */
        }
        .social-links li {
            display: inline-block;
            margin: 10px; /* Отступы между иконками */
        }
        .social-links a {
            display: block;
            width: 80px; /* Размер иконки */
            height: 80px; /* Размер иконки */
            border-radius: 50%;
            overflow: hidden;
            text-align: center;
            line-height: 80px; 
            transition: transform 0.3s;
            color: white; /* Цвет иконки */
            font-size: 36px; /* Размер иконки */
        }
        .social-links a:hover {
            transform: scale(1.1);
        }
        .vk { background-color: #4c75a3; }
        .telegram { background-color: #0088cc; }

        /* Медиа-запрос для уменьшения размера иконок на маленьких экранах */
        @media (max-width: 600px) {
            .links-block h2 {
                font-size: 20px; /* Уменьшенный размер заголовка */
            }
            .social-links a {
                width: 64px; /* Уменьшение размера иконки */
                height: 64px; /* Уменьшение размера иконки */
                line-height: 64px; 
                font-size: 28px; /* Уменьшенный размер иконки */
            }
        }

        /* Медиа-запросы для ещё более маленьких экранов */
        @media (max-width: 400px) {
            .links-block h2 {
                font-size: 18px; /* Уменьшенный размер заголовка */
            }
            .social-links a {
                width: 56px; /* Уменьшение размера иконки */
                height: 56px; /* Уменьшение размера иконки */
                line-height: 56px; 
                font-size: 24px; /* Уменьшенный размер иконки */
            }
        }
    </style>
    <div class="links-block">
        <h2>Наши социальные сети</h2>
        <ul class="social-links">
            <li>
                <a href="https://vk.com/fenixail" target="_blank" class="vk">
                    <i class="fab fa-vk"></i>
                </a>
            </li>
            <li>
                <a href="https://t.me/Fenixail" target="_blank" class="telegram">
                    <i class="fab fa-telegram-plane"></i>
                </a>
            </li>
        </ul>
    </div>
    
    <footer class="footer">
        <p>&copy; 2024 Liderhouse. Все права защищены.</p>
    </footer>
</body>
</html>
