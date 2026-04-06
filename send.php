<?php
// send.php - Обработчик отправки формы в Telegram

// 1. Конфигурация из .env
$env = parse_ini_file(__DIR__ . '/.env');
$botToken = $env['BOT_TOKEN'] ?? '';
$chatId = $env['ADMIN_ID'] ?? '';

if (!$botToken || !$chatId) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'description' => 'Server configuration error']);
    exit();
}

// 1.1. Проверка метода (Разрешаем только POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'description' => 'Method Not Allowed']);
    exit();
}

// 1.2. Rate-limiting (1 заявка в 60 секунд с одного IP)
session_start();
$now = time();
if (isset($_SESSION['last_submit']) && ($now - $_SESSION['last_submit']) < 60) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'description' => 'Слишком частые запросы. Подождите минуту.']);
    exit();
}

// 2. Получаем данные из JS (JSON)
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// 3. Проверка Honeypot (Защита от спама)
if (!empty($input['website'])) {
    http_response_code(200);
    echo json_encode(['ok' => true, 'status' => 'spam_blocked']);
    exit();
}

if (!$input) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'description' => 'No data']);
    exit();
}

// 4. Формируем сообщение
$name = htmlspecialchars($input['name'] ?? 'Не указано');
$city = htmlspecialchars($input['city'] ?? 'Не указано');
$phone = htmlspecialchars($input['phone'] ?? 'Не указано');
$method = htmlspecialchars($input['method'] ?? 'Не указано');
$desc = htmlspecialchars($input['description'] ?? 'Нет комментария');

$text = "🔥 *НОВАЯ ЗАЯВКА SAVONCHIK.RU*\n";
$text .= "👤 *Имя:* " . $name . "\n";
$text .= "🏙 *Город:* " . $city . "\n";
$text .= "📞 *Телефон:* " . $phone . "\n";
$text .= "💬 *Способ:* " . $method . "\n";
$text .= "📝 *Инфо:* " . $desc;

// 5. Отправляем в Telegram
$url = "https://api.telegram.org/bot{$botToken}/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'Markdown'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 6. Фиксируем время отправки для rate-limiting
$_SESSION['last_submit'] = $now;

// 7. Возвращаем ответ сайту
http_response_code($httpCode);
echo $response;
?>