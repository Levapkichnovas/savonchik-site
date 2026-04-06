<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Таймаут сессии — 30 минут
$sessionTimeout = 1800;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $sessionTimeout) {
    session_destroy();
    header('Location: login.php');
    exit();
}
$_SESSION['last_activity'] = time();

// CSRF-токен
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Загрузка данных
$dataFile = '../data.json';
$data = json_decode(file_get_contents($dataFile), true);

// Обработка сохранения
$saved = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Ошибка безопасности (CSRF). Перезагрузите страницу.';
    } else {
    // Контакты и общие настройки
    $data['phone'] = trim($_POST['phone'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['telegram'] = trim($_POST['telegram'] ?? '');
    $data['hero_title'] = trim($_POST['hero_title'] ?? '');
    $data['hero_subtitle'] = trim($_POST['hero_subtitle'] ?? '');
    $data['hero_badge'] = trim($_POST['hero_badge'] ?? '');

    // Цены
    $data['pricing_title'] = trim($_POST['pricing_title'] ?? '');
    $data['pricing_subtitle'] = trim($_POST['pricing_subtitle'] ?? '');
    $data['price_template'] = trim($_POST['price_template'] ?? '');
    $data['price_turnkey'] = trim($_POST['price_turnkey'] ?? '');
    $data['price_vip'] = trim($_POST['price_vip'] ?? '');

    // Обо мне
    $data['about_title'] = trim($_POST['about_title'] ?? '');
    $data['about_subtitle'] = trim($_POST['about_subtitle'] ?? '');
    $data['feature_1_title'] = trim($_POST['feature_1_title'] ?? '');
    $data['feature_1_text'] = trim($_POST['feature_1_text'] ?? '');
    $data['feature_2_title'] = trim($_POST['feature_2_title'] ?? '');
    $data['feature_2_text'] = trim($_POST['feature_2_text'] ?? '');
    $data['feature_3_title'] = trim($_POST['feature_3_title'] ?? '');
    $data['feature_3_text'] = trim($_POST['feature_3_text'] ?? '');

    // Этапы
    $data['steps_title'] = trim($_POST['steps_title'] ?? '');
    $data['steps_subtitle'] = trim($_POST['steps_subtitle'] ?? '');
    $data['step_1_title'] = trim($_POST['step_1_title'] ?? '');
    $data['step_1_text'] = trim($_POST['step_1_text'] ?? '');
    $data['step_2_title'] = trim($_POST['step_2_title'] ?? '');
    $data['step_2_text'] = trim($_POST['step_2_text'] ?? '');
    $data['step_3_title'] = trim($_POST['step_3_title'] ?? '');
    $data['step_3_text'] = trim($_POST['step_3_text'] ?? '');

    // FAQ
    $data['faq_title'] = trim($_POST['faq_title'] ?? '');
    $data['faq_1_q'] = trim($_POST['faq_1_q'] ?? '');
    $data['faq_1_a'] = trim($_POST['faq_1_a'] ?? '');
    $data['faq_2_q'] = trim($_POST['faq_2_q'] ?? '');
    $data['faq_2_a'] = trim($_POST['faq_2_a'] ?? '');
    $data['faq_3_q'] = trim($_POST['faq_3_q'] ?? '');
    $data['faq_3_a'] = trim($_POST['faq_3_a'] ?? '');

    // Контакты и Футер
    $data['contact_title'] = trim($_POST['contact_title'] ?? '');
    $data['contact_text'] = trim($_POST['contact_text'] ?? '');
    $data['footer_legal'] = trim($_POST['footer_legal'] ?? '');

    // Валидация email
    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Некорректный формат email!';
    }

    if (!$error) {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $result = file_put_contents($dataFile, $jsonData);

        if ($result !== false) {
            $saved = true;
            // Обновить CSRF-токен после успешного сохранения
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } else {
            $error = 'Ошибка сохранения! Проверьте права доступа к файлу data.json';
        }
    }
    } // end CSRF else
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель - Редактор сайта</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; border-radius: 20px; padding: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        h1 { color: #333; margin-bottom: 30px; text-align: center; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #555; font-weight: 500; }
        input, textarea { width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border 0.3s; }
        input:focus, textarea:focus { outline: none; border-color: #667eea; }
        .btn { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 30px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; width: 100%; margin-top: 20px; }
        .btn:hover { opacity: 0.9; }
        .success { background: #4caf50; color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .logout { text-align: center; margin-top: 20px; }
        .logout a { color: #667eea; text-decoration: none; }
        h2 { margin-top: 30px; margin-bottom: 15px; font-size: 1.2em; border-bottom: 2px solid #eee; padding-bottom: 10px; color: #444; }
    </style>
</head>
<body>
<div class="container">
    <h1>🎨 Редактор контента сайта</h1>
    
    <?php if ($saved): ?>
        <div class="success">✅ Изменения сохранены!</div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div class="success" style="background: #f44336;">❌ <?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <!-- Основное -->
        <h2>🏠 Главная и контакты</h2>
        <div class="form-group">
            <label>📞 Телефон</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
        </div>
        
        <div class="form-group">
            <label>📧 Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>">
        </div>
        
        <div class="form-group">
            <label>💬 Telegram (ник)</label>
            <input type="text" name="telegram" value="<?= htmlspecialchars($data['telegram']) ?>">
        </div>

        <div class="form-group">
            <label>🏷️ Бейдж (верхняя плашка)</label>
            <input type="text" name="hero_badge" value="<?= htmlspecialchars($data['hero_badge']) ?>">
        </div>
        
        <div class="form-group">
            <label>🎯 Заголовок (Hero)</label>
            <input type="text" name="hero_title" value="<?= htmlspecialchars($data['hero_title']) ?>">
        </div>
        
        <div class="form-group">
            <label>📝 Подзаголовок (Hero)</label>
            <textarea name="hero_subtitle" rows="3"><?= htmlspecialchars($data['hero_subtitle']) ?></textarea>
        </div>

        <!-- Обо мне -->
        <h2>👤 Обо мне (Почему я?)</h2>
        <div class="form-group">
            <label>Заголовок секции</label>
            <input type="text" name="about_title" value="<?= htmlspecialchars($data['about_title']) ?>">
        </div>
        <div class="form-group">
            <label>Подзаголовок секции</label>
            <textarea name="about_subtitle" rows="2"><?= htmlspecialchars($data['about_subtitle']) ?></textarea>
        </div>
        
        <div class="form-group">
            <label>1. Заголовок и Текст преимущества</label>
            <input type="text" name="feature_1_title" value="<?= htmlspecialchars($data['feature_1_title']) ?>" style="margin-bottom: 5px;">
            <textarea name="feature_1_text" rows="2"><?= htmlspecialchars($data['feature_1_text']) ?></textarea>
        </div>
        <div class="form-group">
            <label>2. Заголовок и Текст преимущества</label>
            <input type="text" name="feature_2_title" value="<?= htmlspecialchars($data['feature_2_title']) ?>" style="margin-bottom: 5px;">
            <textarea name="feature_2_text" rows="2"><?= htmlspecialchars($data['feature_2_text']) ?></textarea>
        </div>
        <div class="form-group">
            <label>3. Заголовок и Текст преимущества</label>
            <input type="text" name="feature_3_title" value="<?= htmlspecialchars($data['feature_3_title']) ?>" style="margin-bottom: 5px;">
            <textarea name="feature_3_text" rows="2"><?= htmlspecialchars($data['feature_3_text']) ?></textarea>
        </div>

        <!-- Этапы -->
        <h2>🚀 Этапы работы</h2>
        <div class="form-group">
            <label>Заголовок секции</label>
            <input type="text" name="steps_title" value="<?= htmlspecialchars($data['steps_title']) ?>">
        </div>
        <div class="form-group">
            <label>Подзаголовок секции</label>
            <textarea name="steps_subtitle" rows="2"><?= htmlspecialchars($data['steps_subtitle']) ?></textarea>
        </div>

        <div class="form-group">
            <label>1. Этап</label>
            <input type="text" name="step_1_title" value="<?= htmlspecialchars($data['step_1_title']) ?>" style="margin-bottom: 5px;">
            <textarea name="step_1_text" rows="2"><?= htmlspecialchars($data['step_1_text']) ?></textarea>
        </div>
        <div class="form-group">
            <label>2. Этап</label>
            <input type="text" name="step_2_title" value="<?= htmlspecialchars($data['step_2_title']) ?>" style="margin-bottom: 5px;">
            <textarea name="step_2_text" rows="2"><?= htmlspecialchars($data['step_2_text']) ?></textarea>
        </div>
        <div class="form-group">
            <label>3. Этап</label>
            <input type="text" name="step_3_title" value="<?= htmlspecialchars($data['step_3_title']) ?>" style="margin-bottom: 5px;">
            <textarea name="step_3_text" rows="2"><?= htmlspecialchars($data['step_3_text']) ?></textarea>
        </div>

        <!-- Цены -->
        <h2>💰 Цены</h2>
        <div class="form-group">
            <label>Заголовок секции</label>
            <input type="text" name="pricing_title" value="<?= htmlspecialchars($data['pricing_title']) ?>">
        </div>
        <div class="form-group">
            <label>Подзаголовок секции</label>
            <textarea name="pricing_subtitle" rows="2"><?= htmlspecialchars($data['pricing_subtitle']) ?></textarea>
        </div>

        <div class="form-group">
            <label>Цена "Шаблон" (₽)</label>
            <input type="text" name="price_template" value="<?= htmlspecialchars($data['price_template']) ?>">
        </div>
        
        <div class="form-group">
            <label>Цена "Под ключ" (₽)</label>
            <input type="text" name="price_turnkey" value="<?= htmlspecialchars($data['price_turnkey']) ?>">
        </div>
        
        <div class="form-group">
            <label>Цена "VIP" (₽)</label>
            <input type="text" name="price_vip" value="<?= htmlspecialchars($data['price_vip']) ?>">
        </div>

        <!-- FAQ -->
        <h2>❓ FAQ (Вопрос-Ответ)</h2>
        <div class="form-group">
            <label>Заголовок секции</label>
            <input type="text" name="faq_title" value="<?= htmlspecialchars($data['faq_title']) ?>">
        </div>

        <div class="form-group">
            <label>1. Вопрос и Ответ</label>
            <input type="text" name="faq_1_q" value="<?= htmlspecialchars($data['faq_1_q']) ?>" style="margin-bottom: 5px;">
            <textarea name="faq_1_a" rows="2"><?= htmlspecialchars($data['faq_1_a']) ?></textarea>
        </div>
        <div class="form-group">
            <label>2. Вопрос и Ответ</label>
            <input type="text" name="faq_2_q" value="<?= htmlspecialchars($data['faq_2_q']) ?>" style="margin-bottom: 5px;">
            <textarea name="faq_2_a" rows="2"><?= htmlspecialchars($data['faq_2_a']) ?></textarea>
        </div>
        <div class="form-group">
            <label>3. Вопрос и Ответ</label>
            <input type="text" name="faq_3_q" value="<?= htmlspecialchars($data['faq_3_q']) ?>" style="margin-bottom: 5px;">
            <textarea name="faq_3_a" rows="2"><?= htmlspecialchars($data['faq_3_a']) ?></textarea>
        </div>

        <!-- Футер -->
        <h2>🔻 Футер (Низ сайта)</h2>
        <div class="form-group">
            <label>Заголовок контактов</label>
            <input type="text" name="contact_title" value="<?= htmlspecialchars($data['contact_title']) ?>">
        </div>
        <div class="form-group">
            <label>Текст призыва</label>
            <textarea name="contact_text" rows="2"><?= htmlspecialchars($data['contact_text']) ?></textarea>
        </div>
        <div class="form-group">
            <label>Юридическая информация</label>
            <textarea name="footer_legal" rows="2"><?= htmlspecialchars($data['footer_legal']) ?></textarea>
        </div>
        
        <button type="submit" class="btn">💾 Сохранить изменения</button>
    </form>
    
    <div class="logout">
        <a href="logout.php">🚪 Выйти</a>
    </div>
</div>
</body>
</html>