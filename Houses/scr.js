let currentSlide = 0; // Индекс текущего слайда
const slides = document.querySelectorAll('.slide'); // Получаем все изображения

function showSlide(index) {
    // Убедимся, что индекс в пределах массива
    if (index >= slides.length) {
        currentSlide = 0; // Если вышли за пределы, возвращаемся к первому
    } else if (index < 0) {
        currentSlide = slides.length - 1; // Если меньше 0, переходим на последний
    } else {
        currentSlide = index; // Обновляем текущий слайд
    }
    
    // Сдвигаем слайды
    const sliderImages = document.querySelector('.slider-images');
    sliderImages.style.transform = `translateX(${-currentSlide * 100}%)`;
}

function changeSlide(direction) {
    showSlide(currentSlide + direction); // Меняем слайд по направлению
}

// Показываем первый слайд при загрузке
showSlide(currentSlide);
