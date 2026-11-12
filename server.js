const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const mysql = require('mysql2');

const app = express();

// Настройка CORS и парсинг JSON
app.use(cors());
app.use(bodyParser.json());

// Подключение к базе данных
const db = mysql.createConnection({
  host: 'localhost', // или IP-адрес вашего сервера
  user: 'ваш_пользователь', // замените на ваше имя пользователя
  password: 'ваш_пароль', // замените на ваш пароль
  database: 'ваша_база_данных' // замените на имя вашей базы данных
});

// Соединение с базой данных
db.connect(err => {
  if (err) {
    console.error('Ошибка подключения к базе данных:', err);
    return;
  }
  console.log('Подключено к базе данных MySQL');
});

// Эндпоинт для добавления/удаления лайка
app.post('/like', (req, res) => {
  const { userId, propertyId } = req.body;

  // Проверяем, существует ли лайк
  db.query('SELECT * FROM likes WHERE user_id = ? AND property_id = ?', [userId, propertyId], (error, results) => {
    if (error) {
      console.error('Ошибка при выполнении запроса:', error);
      return res.status(500).json({ error: 'Ошибка сервера' });
    }

    if (results.length > 0) {
      // Лайк уже существует, удаляем его
      db.query('DELETE FROM likes WHERE user_id = ? AND property_id = ?', [userId, propertyId], (error) => {
        if (error) {
          console.error('Ошибка при удалении лайка:', error);
          return res.status(500).json({ error: 'Ошибка сервера' });
        }
        return res.json({ liked: false });
      });
    } else {
      // Лайк не существует, добавляем его
      db.query('INSERT INTO likes (user_id, property_id) VALUES (?, ?)', [userId, propertyId], (error) => {
        if (error) {
          console.error('Ошибка при добавлении лайка:', error);
          return res.status(500).json({ error: 'Ошибка сервера' });
        }
        return res.json({ liked: true });
      });
    }
  });
});

// Эндпоинт для получения лайков пользователя
app.get('/likes/:userId', (req, res) => {
  const userId = req.params.userId;

  db.query('SELECT property_id FROM likes WHERE user_id = ?', [userId], (error, results) => {
    if (error) {
      console.error('Ошибка при выполнении запроса:', error);
      return res.status(500).json({ error: 'Ошибка сервера' });
    }
    res.json(results);
  });
});

// Запуск сервера
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => {
  console.log(`Сервер запущен на порту ${PORT}`);
});
