document.addEventListener('DOMContentLoaded', () => {
    const likeButtons = document.querySelectorAll('.like-btn');
    const likesDropdown = document.querySelector('.likes-dropdown');

    // Подключаем событие для кнопок "Лайк"
    likeButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const property = {
                title: this.dataset.title,
                location: this.dataset.location,
                price: this.dataset.price,
                imageUrl: this.dataset.imageUrl,
                detailUrl: this.dataset.detailUrl
            };

            let likedHouses = JSON.parse(localStorage.getItem('likedHouses')) || [];
            const existingHouseIndex = likedHouses.findIndex(item => item.title === property.title);

            if (existingHouseIndex !== -1) {
                likedHouses.splice(existingHouseIndex, 1); // Удаляем лайк
                this.textContent = '❤️'; // Обновляем текст кнопки
            } else {
                likedHouses.push(property); // Добавляем в список лайков
                this.textContent = '❤️ Лайкнуто';
            }

            localStorage.setItem('likedHouses', JSON.stringify(likedHouses));
            updateLikesDropdown(likedHouses);
        });
    });

    // Обновляем выпадающее меню на основе лайков
    function updateLikesDropdown(likedHouses) {
        likesDropdown.innerHTML = ''; // Очищаем текущее содержимое

        if (likedHouses.length === 0) {
            likesDropdown.innerHTML = '<li>Нет лайкнутых домов</li>';
        } else {
            likedHouses.forEach(property => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <a href="${property.detailUrl}">
                        <img src="${property.imageUrl}" alt="${property.title}" style="width: 50px; margin-right: 10px;">
                        <span>${property.title} - ${property.price}</span>
                    </a>
                `;
                likesDropdown.appendChild(li);
            });
        }
    }

    // Инициализируем выпадающее меню при загрузке страницы
    const likedHouses = JSON.parse(localStorage.getItem('likedHouses')) || [];
    updateLikesDropdown(likedHouses);
    
});
