document.addEventListener('DOMContentLoaded', () => {

    // 0. Защита от копирования (отключение правой кнопки мыши)
    document.addEventListener('contextmenu', (e) => {
        e.preventDefault();
    });

    // 1. Инициализация анимаций при скролле (AOS)
    AOS.init({
        once: true, // анимация проигрывается один раз
        offset: 100, // сдвиг начала анимации
        duration: 800,
        easing: 'ease-out-cubic'
    });

    // 2. Мобильное меню
    const mobileToggle = document.querySelector('.mobile-toggle');
    const navLinks = document.querySelector('.nav-links');
    const header = document.querySelector('header');

    mobileToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        const icon = mobileToggle.querySelector('i');
        if (navLinks.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.add('fa-bars');
            icon.classList.remove('fa-times');
        }
    });

    // Скрытие меню при клике на ссылку
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('active');
            mobileToggle.querySelector('i').classList.add('fa-bars');
            mobileToggle.querySelector('i').classList.remove('fa-times');
        });
    });

    // Эффект тени у хедера при скролле
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.boxShadow = '0 5px 20px rgba(0,0,0,0.05)';
            header.style.background = 'rgba(255,255,255,0.95)';
        } else {
            header.style.boxShadow = 'none';
            header.style.background = 'rgba(248, 250, 252, 0.8)';
        }
    });

    // 3. Аккордеон FAQ
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        item.querySelector('.faq-question').addEventListener('click', () => {
            // Закрываем другие (опционально)
            // faqItems.forEach(i => { if(i !== item) i.classList.remove('active'); });
            item.classList.toggle('active');
        });
    });

    // 4. Логика модальных окон
    const overlay = document.getElementById('modalOverlay');
    const closeModalButtons = document.querySelectorAll('.close-modal');

    window.openModal = function (modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            overlay.classList.add('active');
            modal.style.display = 'block';
            setTimeout(() => modal.classList.add('active'), 10);
        }
    }

    function closeModals() {
        overlay.classList.remove('active');
        document.querySelectorAll('.modal').forEach(m => {
            m.classList.remove('active');
            setTimeout(() => m.style.display = 'none', 300);
        });
    }

    overlay.addEventListener('click', closeModals);
    closeModalButtons.forEach(btn => btn.addEventListener('click', closeModals));

    // 5. Выбор тарифа
    window.selectTariff = function (tariffName) {
        const descField = document.getElementById('descField');
        const contactSection = document.getElementById('contact');

        descField.value = `Выбран тариф: ${tariffName}. `;
        // Плавная прокрутка к форме
        contactSection.scrollIntoView({ behavior: 'smooth' });
        // Фокус и эффект floating label
        setTimeout(() => descField.focus(), 800);
    }

    // 6. Cookie Banner
    if (!localStorage.getItem('cookiesAccepted')) {
        setTimeout(() => {
            document.getElementById('cookieBanner').style.display = 'flex';
        }, 2000);
    }

    window.acceptCookies = function () {
        document.getElementById('cookieBanner').style.display = 'none';
        localStorage.setItem('cookiesAccepted', 'true');
    }

    // 7. Маска для телефона
    const phoneInput = document.getElementById('inpPhone');
    if (phoneInput) {
        phoneInput.addEventListener('input', (e) => {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            if (!x[2] && x[1] !== '') {
                // Если ввели только одну цифру и это 8 или 7, заменяем на +7
                e.target.value = '+7';
            } else { // иначе формируем маску
                e.target.value = !x[2] ? x[1] : '+7 (' + x[2] + (x[3] ? ') ' + x[3] : '') + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
            }
        });
        // Устанавливаем +7 при фокусе, если пусто
        phoneInput.addEventListener('focus', (e) => {
            if (e.target.value === '') {
                e.target.value = '+7';
            }
        });
    }

    // 8. Отправка формы (Telegram Integration)
    const form = document.getElementById('leadForm');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const statusDiv = document.getElementById('formStatus');

        // Валидация телефона (полный формат +7 (xxx) xxx-xx-xx)
        const phone = document.getElementById('inpPhone').value;
        if (phone.length < 18) {
            statusDiv.innerHTML = '<div style="color: var(--accent); margin-top:10px;">❗ Введите полный номер телефона</div>';
            return;
        }

        const btn = form.querySelector('button');

        // Данные
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        // UI Loading state
        const originalBtnText = btn.innerHTML; // Store original button text
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Отправка...';

        try {
            const response = await fetch('send.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.ok || result.status === 'spam_blocked') {
                statusDiv.innerHTML = '<div style="color: var(--primary); margin-top:10px; font-weight:bold;">Спасибо! Заявку получила. Свяжусь с вами в ближайшее время.</div>';
                form.reset();
                setTimeout(() => { statusDiv.innerHTML = ''; }, 5000);
            } else {
                console.error('Telegram Error:', result);
                statusDiv.innerHTML = `<div style="color: var(--accent); margin-top:10px;">Ошибка отправки: ${result.description || 'Попробуйте позже'}</div>`;
            }
        } catch (error) {
            console.error('Network Error:', error);
            statusDiv.innerHTML = '<div style="color: var(--accent); margin-top:10px;">Ошибка сети. Проверьте интернет.</div>';
        } finally {
            btn.disabled = false;
            btn.innerHTML = originalBtnText;
        }
    });
});