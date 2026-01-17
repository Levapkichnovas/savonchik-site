<?php
// send.php - Обработчик отправки формы в Telegram

// 1. Конфигурация (Ваши данные)
$botToken = '7907296875:AAHlW6sG0Vx0L5BznQAxpuMzrCEmAiWu3i0';
$chatId = '1114084067';

// 1.1. Проверка метода (Разрешаем только POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'description' => 'Method Not Allowed']);
    exit();
}

// 2. Получаем данные из JS (JSON)
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// 3. Проверка Honeypot (Защита от спама)
// Если поле 'website' (скрытое) заполнено - это робот
if (!empty($input['website'])) {
    // Имитируем успех, чтобы робот не догадался
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
    'parse_mode' => 'Markdown' // Используем Markdown для жирного текста
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Если есть проблемы с сертификатами на хостинге

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 6. Возвращаем ответ сайту
http_response_code($httpCode);
echo $response;
?>