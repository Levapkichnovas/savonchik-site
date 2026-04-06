<?php
// Загрузка данных из JSON
$data = json_decode(file_get_contents('data.json'), true);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бизнес-план для соцконтракта | Анастасия Савончик</title>
    <meta name="description"
        content="Помощь в получении соцконтракта до 350 000 рублей. Разработка бизнес-плана с гарантией одобрения. Сопровождение до выплаты.">
    <meta name="keywords"
        content="соцконтракт, социальный контракт 2026, бизнес-план для соцконтракта, 350000 рублей от государства, помощь в получении соцконтракта, бизнес-план образец, господдержка малого бизнеса">

    <!-- Open Graph / Facebook / Telegram -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://savonchik.ru/">
    <meta property="og:title" content="Бизнес-план для соцконтракта | Анастасия Савончик">
    <meta property="og:description"
        content="Получите 350 000 ₽ на свой бизнес. Гарантия качества, сопровождение до выплаты, индивидуальный расчет.">
    <meta property="og:image" content="https://savonchik.ru/1.jpg">

    <!-- Современные шрифты: Montserrat (заголовки) и Inter (текст) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Montserrat:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Библиотека анимаций AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Иконки -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Наш стиль -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Фоновые декоративные элементы (пятна) -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <!-- Навигация -->
    <header id="header">
        <div class="container nav-content">
            <a href="index.html" class="logo">SAVONCHIK<span class="dot">.</span>RU</a>
            <div class="mobile-toggle"><i class="fas fa-bars"></i></div>
            <ul class="nav-links">
                <li><a href="#about">Обо мне</a></li>
                <li><a href="#services">Этапы</a></li>
                <li><a href="#pricing">Тарифы</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact" class="btn-nav">Заполнить заявку</a></li>
            </ul>
        </div>
    </header>

    <!-- Hero Секция -->
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-text" data-aos="fade-right" data-aos-duration="1000">
                <div class="badge">
                    <?= htmlspecialchars($data['hero_badge']) ?>
                </div>
                <h1>
                    <?= $data['hero_title'] ?>
                </h1>
                <p>
                    <?= htmlspecialchars($data['hero_subtitle']) ?>
                </p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary pulse-anim">Хочу получить выплату</a>
                    <a href="#pricing" class="btn btn-transparent"><i class="fas fa-arrow-down"></i> Выбрать тариф</a>
                </div>

                <div class="stats-row">
                    <div class="stat">
                        <span>350к+</span>
                        <small>Макс. выплата</small>
                    </div>
                    <div class="stat">
                        <span>98%</span>
                        <small>Одобряемость</small>
                    </div>
                </div>
            </div>

            <div class="hero-img-wrapper" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="200">
                <div class="img-card glass">
                    <!-- Замените src на реальное фото -->
                    <img src="1.jpg" alt="Анастасия Савончик">
                    <div class="floating-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Гарантия качества</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Преимущества -->
    <section id="about" class="section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2><?= htmlspecialchars($data['about_title']) ?></h2>
                <p><?= htmlspecialchars($data['about_subtitle']) ?></p>
            </div>
            <div class="features-grid">
                <div class="feature-card glass-hover" data-aos="fade-up" data-aos-delay="0">
                    <div class="icon-box"><i class="fas fa-chart-pie"></i></div>
                    <h3><?= htmlspecialchars($data['feature_1_title']) ?></h3>
                    <p><?= htmlspecialchars($data['feature_1_text']) ?></p>
                </div>
                <div class="feature-card glass-hover" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box"><i class="fas fa-user-shield"></i></div>
                    <h3><?= htmlspecialchars($data['feature_2_title']) ?></h3>
                    <p><?= htmlspecialchars($data['feature_2_text']) ?></p>
                </div>
                <div class="feature-card glass-hover" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box"><i class="fas fa-headset"></i></div>
                    <h3><?= htmlspecialchars($data['feature_3_title']) ?></h3>
                    <p><?= htmlspecialchars($data['feature_3_text']) ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Этапы работы -->
    <section id="services" class="section bg-light">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2><?= htmlspecialchars($data['steps_title']) ?></h2>
                <p><?= htmlspecialchars($data['steps_subtitle']) ?></p>
            </div>
            <div class="features-grid">
                <!-- Шаг 1 -->
                <div class="step-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="icon-box"><i class="fas fa-comments"></i></div>
                    <h3><?= htmlspecialchars($data['step_1_title']) ?></h3>
                    <p><?= htmlspecialchars($data['step_1_text']) ?></p>
                </div>
                <!-- Шаг 2 -->
                <div class="step-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box"><i class="fas fa-file-invoice-dollar"></i></div>
                    <h3><?= htmlspecialchars($data['step_2_title']) ?></h3>
                    <p><?= htmlspecialchars($data['step_2_text']) ?></p>
                </div>
                <!-- Шаг 3 -->
                <div class="step-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box"><i class="fas fa-university"></i></div>
                    <h3><?= htmlspecialchars($data['step_3_title']) ?></h3>
                    <p><?= htmlspecialchars($data['step_3_text']) ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Тарифы -->
    <section id="pricing" class="section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2><?= htmlspecialchars($data['pricing_title']) ?></h2>
                <p><?= htmlspecialchars($data['pricing_subtitle']) ?></p>
            </div>
            <div class="pricing-grid">
                <!-- Тариф Start -->
                <div class="price-card" data-aos="flip-left" data-aos-duration="1000">
                    <div class="price-header">
                        <h3>Шаблон</h3>
                        <div class="price">
                            <?= htmlspecialchars($data['price_template']) ?> ₽
                        </div>
                    </div>
                    <ul class="price-list">
                        <li><i class="fas fa-check"></i> Качественный шаблон</li>
                        <li><i class="fas fa-check"></i> Пример заполнения</li>
                        <li><i class="fas fa-check"></i> Видео-инструкция</li>
                        <li class="disabled"><i class="fas fa-times"></i> Индивидуальный расчет</li>
                    </ul>
                    <button class="btn btn-outline full-width" onclick="selectTariff('Шаблон')">Выбрать</button>
                </div>

                <!-- Тариф Pro (Акцентный) -->
                <div class="price-card popular" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="popular-tag">ХИТ ПРОДАЖ</div>
                    <div class="price-header">
                        <h3>Под ключ</h3>
                        <div class="price">
                            <?= htmlspecialchars($data['price_turnkey']) ?> ₽
                        </div>
                    </div>
                    <ul class="price-list">
                        <li><i class="fas fa-check"></i> <strong>Полная разработка</strong></li>
                        <li><i class="fas fa-check"></i> Анализ конкурентов</li>
                        <li><i class="fas fa-check"></i> Исправление правок</li>
                        <li><i class="fas fa-check"></i> Подготовка к защите</li>
                    </ul>
                    <button class="btn btn-primary full-width" onclick="selectTariff('Под ключ')">Заказать
                        разработку</button>
                </div>

                <!-- Тариф VIP -->
                <div class="price-card" data-aos="flip-right" data-aos-duration="1000">
                    <div class="price-header">
                        <h3>VIP + Отчет</h3>
                        <div class="price">
                            <?= htmlspecialchars($data['price_vip']) ?> ₽
                        </div>
                    </div>
                    <ul class="price-list">
                        <li><i class="fas fa-check"></i> Всё из тарифа "Под ключ"</li>
                        <li><i class="fas fa-check"></i> <strong>Ведение отчетности</strong></li>
                        <li><i class="fas fa-check"></i> Консультация бухгалтера</li>
                        <li><i class="fas fa-check"></i> Приоритетная связь</li>
                    </ul>
                    <button class="btn btn-outline full-width" onclick="selectTariff('VIP')">Выбрать</button>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="section bg-light">
        <div class="container">
            <div class="section-header">
                <h2><?= htmlspecialchars($data['faq_title']) ?></h2>
            </div>
            <div class="faq-wrapper" data-aos="fade-up">
                <div class="faq-item">
                    <div class="faq-question"><?= htmlspecialchars($data['faq_1_q']) ?> <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer"><?= htmlspecialchars($data['faq_1_a']) ?></div>
                </div>
                <div class="faq-item">
                    <div class="faq-question"><?= htmlspecialchars($data['faq_2_q']) ?> <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer"><?= htmlspecialchars($data['faq_2_a']) ?></div>
                </div>
                <div class="faq-item">
                    <div class="faq-question"><?= htmlspecialchars($data['faq_3_q']) ?> <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer"><?= htmlspecialchars($data['faq_3_a']) ?></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Форма -->
    <section id="contact" class="section">
        <div class="container">
            <div class="contact-box glass" data-aos="zoom-in-up">
                <div class="contact-text">
                    <h2><?= htmlspecialchars($data['contact_title']) ?></h2>
                    <p><?= htmlspecialchars($data['contact_text']) ?></p>
                    <div class="contact-info">
                        <div class="c-item"><i class="fab fa-telegram"></i>
                            <?= htmlspecialchars($data['telegram']) ?>
                        </div>
                        <div class="c-item"><i class="fas fa-envelope"></i>
                            <?= htmlspecialchars($data['email']) ?>
                        </div>
                    </div>
                </div>

                <form id="leadForm" class="modern-form">
                    <div class="input-group">
                        <input type="text" name="name" required placeholder=" " id="inpName">
                        <label for="inpName">Ваше имя</label>
                    </div>

                    <div class="row-inputs">
                        <div class="input-group">
                            <input type="text" name="city" required placeholder=" " id="inpCity">
                            <label for="inpCity">Город</label>
                        </div>
                        <div class="input-group">
                            <input type="tel" name="phone" required placeholder=" " id="inpPhone">
                            <label for="inpPhone">Телефон</label>
                        </div>
                    </div>

                    <div class="input-group">
                        <select name="method" class="styled-select">
                            <option value="WhatsApp">Написать в WhatsApp</option>
                            <option value="Telegram">Написать в Telegram</option>
                            <option value="Call">Позвонить мне</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <textarea name="description" id="descField" placeholder=" "></textarea>
                        <label for="descField">Комментарий или выбранный тариф</label>
                    </div>

                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="agreed" required>
                        <label for="agreed">Я согласен на обработку <span class="link"
                                onclick="openModal('policyModal')">персональных данных</span></label>
                    </div>

                    <!-- Honeypot для защиты от спама (пользователь его не видит) -->
                    <input type="text" name="website" style="display:none !important;" tabindex="-1" autocomplete="off">

                    <button type="submit" class="btn btn-primary btn-block">
                        <span>Отправить заявку</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    <div id="formStatus"></div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container footer-content">
            <div class="footer-left">
                <a href="index.html" class="logo">SAVONCHIK<span class="dot">.</span>RU</a>
                <p class="copyright">&copy; 2026 Все права защищены.</p>
            </div>
            <div class="footer-links">
                <span onclick="openModal('policyModal')">Политика конфиденциальности</span>
                <span onclick="openModal('termsModal')">Публичная оферта</span>
                <span onclick="openModal('consentModal')">Согласие на ПДн</span>
            </div>
            <div class="footer-legal">
                <?= htmlspecialchars($data['footer_legal']) ?>
            </div>
        </div>
    </footer>

    <!-- Cookie Banner -->
    <div id="cookieBanner" class="cookie-banner glass">
        <p>🍪 Мы используем cookie для улучшения работы сайта.</p>
        <button onclick="acceptCookies()">ОК</button>
    </div>

    <!-- Модальные окна (Заглушки) -->
    <div id="modalOverlay" class="modal-overlay"></div>

    <div id="policyModal" class="modal glass">
        <span class="close-modal">&times;</span>
        <h3>Политика конфиденциальности</h3>
        <div class="policy-text" style="max-height: 400px; overflow-y: auto; text-align: left; padding-right: 10px;">
            <p><strong>1. Общие положения</strong></p>
            <p>Настоящая политика обработки персональных данных составлена в соответствии с требованиями Федерального
                закона от 27.07.2006. №152-ФЗ «О персональных данных» (далее — Закон о персональных данных) и определяет
                порядок обработки персональных данных и меры по обеспечению безопасности персональных данных,
                предпринимаемые Савончик Анастасией (далее — Оператор).</p>
            <p>1.1. Оператор ставит своей важнейшей целью и условием осуществления своей деятельности соблюдение прав и
                свобод человека и гражданина при обработке его персональных данных, в том числе защиты прав на
                неприкосновенность частной жизни, личную и семейную тайну.</p>
            <p>1.2. Настоящая политика Оператора в отношении обработки персональных данных (далее — Политика)
                применяется ко всей информации, которую Оператор может получить о посетителях веб-сайта
                https://savonchik.ru (и его поддоменов).</p>

            <p><strong>2. Основные понятия, используемые в Политике</strong></p>
            <p>2.1. Автоматизированная обработка персональных данных — обработка персональных данных с помощью средств
                вычислительной техники.</p>
            <p>2.2. Блокирование персональных данных — временное прекращение обработки персональных данных (за
                исключением случаев, если обработка необходима для уточнения персональных данных).</p>
            <p>2.3. Веб-сайт — совокупность графических и информационных материалов, а также программ для ЭВМ и баз
                данных, обеспечивающих их доступность в сети интернет по сетевому адресу https://savonchik.ru.</p>
            <p>2.4. Персональные данные — любая информация, относящаяся прямо или косвенно к определенному или
                определяемому Пользователю веб-сайта.</p>
            <p>2.5. Пользователь — любой посетитель веб-сайта.</p>

            <p><strong>3. Оператор может обрабатывать следующие персональные данные Пользователя</strong></p>
            <p>3.1. Фамилия, имя, отчество.</p>
            <p>3.2. Номер телефона.</p>
            <p>3.3. Город проживания.</p>
            <p>3.4. Также на сайте происходит сбор и обработка обезличенных данных о посетителях (в т.ч. файлов
                «cookie») с помощью сервисов интернет-статистики (Яндекс Метрика и Гугл Аналитика и других).</p>

            <p><strong>4. Цели обработки персональных данных</strong></p>
            <p>4.1. Цель обработки персональных данных Пользователя — информирование Пользователя посредством отправки
                электронных писем; предоставление доступа Пользователю к сервисам, информации и/или материалам,
                содержащимся на веб-сайте; уточнение деталей заказа услуг.</p>
            <p>4.2. Также Оператор имеет право направлять Пользователю уведомления о новых продуктах и услугах,
                специальных предложениях и различных событиях. Пользователь всегда может отказаться от получения
                информационных сообщений, направив Оператору письмо на адрес электронной почты info@savonchik.ru с
                пометкой «Отказ от уведомлений о новых продуктах и услугах и специальных предложениях».</p>

            <p><strong>5. Правовые основания обработки персональных данных</strong></p>
            <p>5.1. Оператор обрабатывает персональные данные Пользователя только в случае их заполнения и/или отправки
                Пользователем самостоятельно через специальные формы, расположенные на сайте. Заполняя соответствующие
                формы и/или отправляя свои персональные данные Оператору, Пользователь выражает свое согласие с данной
                Политикой.</p>
            <p>5.2. Оператор обрабатывает обезличенные данные о Пользователе в случае, если это разрешено в настройках
                браузера Пользователя (включено сохранение файлов «cookie» и использование технологии JavaScript).</p>

            <p><strong>6. Порядок сбора, хранения, передачи и других видов обработки персональных данных</strong></p>
            <p>6.1. Безопасность персональных данных, которые обрабатываются Оператором, обеспечивается путем реализации
                правовых, организационных и технических мер, необходимых для выполнения в полном объеме требований
                действующего законодательства в области защиты персональных данных.</p>
            <p>6.2. Оператор обеспечивает сохранность персональных данных и принимает все возможные меры, исключающие
                доступ к персональным данным неуполномоченных лиц.</p>
            <p>6.3. Персональные данные Пользователя никогда, ни при каких условиях не будут переданы третьим лицам, за
                исключением случаев, связанных с исполнением действующего законодательства.</p>
            <p>6.4. Срок обработки персональных данных является неограниченным. Пользователь может в любой момент
                отозвать свое согласие на обработку персональных данных, направив Оператору уведомление посредством
                электронной почты на электронный адрес Оператора info@savonchik.ru с пометкой «Отзыв согласия на
                обработку персональных данных».</p>

            <p><strong>7. Заключительные положения</strong></p>
            <p>7.1. Пользователь может получить любые разъяснения по интересующим вопросам, касающимся обработки его
                персональных данных, обратившись к Оператору с помощью электронной почты info@savonchik.ru.</p>
            <p>7.2. В данном документе будут отражены любые изменения политики обработки персональных данных Оператором.
                Политика действует бессрочно до замены ее новой версией.</p>
        </div>
    </div>

    <div id="termsModal" class="modal glass">
        <span class="close-modal">&times;</span>
        <h3>Пользовательское соглашение</h3>
        <div class="policy-text" style="max-height: 400px; overflow-y: auto; text-align: left; padding-right: 10px;">
            <p><strong>Публичная оферта на оказание информационно-консультационных услуг</strong></p>
            <p>Настоящий документ является официальным предложением (публичной офертой) Савончик Анастасии (далее —
                Исполнитель) и содержит все существенные условия предоставления информационно-консультационных услуг
                любому юридическому или физическому лицу (далее — Заказчик).</p>

            <p><strong>1. Предмет оферты</strong></p>
            <p>1.1. Исполнитель обязуется оказать Заказчику информационно-консультационные услуги по разработке
                бизнес-планов и подготовке документов для заключения социального контракта (далее — Услуги), а Заказчик
                обязуется оплатить эти Услуги.</p>
            <p>1.2. Полный перечень Услуг, их стоимость и описание опубликованы на сайте https://savonchik.ru.</p>

            <p><strong>2. Порядок заключения договора</strong></p>
            <p>2.1. Акцептом (принятием) оферты является полная или частичная оплата Услуг Заказчиком.</p>
            <p>2.2. Договор считается заключенным с момента поступления денежных средств на счет Исполнителя.</p>

            <p><strong>3. Права и обязанности сторон</strong></p>
            <p>3.1. Исполнитель обязан: оказать Услуги качественно и в срок; сохранять конфиденциальность полученной от
                Заказчика информации.</p>
            <p>3.2. Заказчик обязан: предоставить достоверную информацию, необходимую для оказания Услуг; своевременно
                оплатить Услуги.</p>

            <p><strong>4. Стоимость услуг и порядок расчетов</strong></p>
            <p>4.1. Стоимость Услуг определяется в соответствии с тарифами, указанными на сайте.</p>
            <p>4.2. Исполнитель имеет право в одностороннем порядке изменять стоимость Услуг. Новая стоимость не
                распространяется на уже оплаченные Услуги.</p>

            <p><strong>5. Ответственность сторон</strong></p>
            <p>5.1. Исполнитель не несет ответственности за отказ государственных органов в заключении социального
                контракта, если такой отказ не связан с качеством подготовленного бизнес-плана (например, если Заказчик
                не соответствует критериям нуждаемости).</p>
            <p>5.2. Исполнитель гарантирует бесплатное устранение недостатков в документах, если они возникли по вине
                Исполнителя.</p>

            <p><strong>6. Заключительные положения</strong></p>
            <p>6.1. Все споры и разногласия решаются путем переговоров.</p>
            <p>6.2. Исполнитель оставляет за собой право вносить изменения в текст настоящей Оферты без специального
                уведомления Заказчика.</p>

            <br>
            <p><strong>Реквизиты Исполнителя:</strong></p>
            <p>Савончик Анастасия</p>
            <p>Email: info@savonchik.ru</p>
        </div>
    </div>

    <div id="consentModal" class="modal glass">
        <span class="close-modal">&times;</span>
        <h3>Согласие на обработку данных</h3>
        <div class="policy-text" style="max-height: 400px; overflow-y: auto; text-align: left; padding-right: 10px;">
            <p><strong>Согласие на обработку персональных данных</strong></p>
            <p>Настоящим я, далее – «Субъект Персональных Данных», во исполнение требований Федерального закона от
                27.07.2006 г. № 152-ФЗ «О персональных данных» (с изменениями и дополнениями) свободно, своей волей и в
                своем интересе даю свое согласие Савончик Анастасии (далее – «Оператор») на обработку своих персональных
                данных, указанных при регистрации путем заполнения веб-формы на сайте https://savonchik.ru и его
                поддоменов.</p>

            <p><strong>1. Перечень персональных данных</strong></p>
            <p>Под персональными данными я понимаю любую информацию, относящуюся ко мне как к Субъекту Персональных
                Данных, в том числе:<br>
                — Фамилия, имя, отчество;<br>
                — Контактный телефон;<br>
                — Город проживания;<br>
                — Иная информация, указанная мной в поле «Комментарий».</p>

            <p><strong>2. Цели обработки</strong></p>
            <p>Обработка персональных данных осуществляется в целях:<br>
                — Оказания мне консультационных услуг;<br>
                — Предоставления доступа к материалам сайта;<br>
                — Направления уведомлений, запросов и информации, касающихся использования сайта и оказания услуг;<br>
                — Обработки моих запросов и заявок.</p>

            <p><strong>3. Действия с данными</strong></p>
            <p>Под обработкой персональных данных я понимаю сбор, систематизацию, накопление, уточнение, обновление,
                изменение, использование, распространение, передачу, в том числе трансграничную, обезличивание,
                блокирование, уничтожение, бессрочное хранение, и любые другие действия (операции) с персональными
                данными.</p>

            <p><strong>4. Срок действия и порядок отзыва</strong></p>
            <p>Датой выдачи согласия на обработку персональных данных Субъекта Персональных Данных является дата
                отправки регистрационной веб-формы с сайта.<br>
                Обработка персональных данных Субъекта Персональных Данных может осуществляться без ограничения срока,
                любым законным способом, в том числе в информационных системах персональных данных с использованием
                средств автоматизации или без использования таких средств.<br>
                Я ознакомлен(а), что настоящее согласие на обработку моих персональных данных является бессрочным и
                может быть отозвано посредством направления заявления в свободной форме на электронный адрес Оператора:
                info@savonchik.ru.</p>
        </div>
    </div>

    <!-- Скрипты -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="script.js"></script>
</body>

</html>