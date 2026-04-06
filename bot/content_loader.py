import json
import os

# Путь к файлу data.json (на один уровень выше папки bot)
DATA_FILE_PATH = os.path.join(os.path.dirname(os.path.dirname(__file__)), 'data.json')

def load_data():
    """Загружает данные из data.json"""
    if not os.path.exists(DATA_FILE_PATH):
        return {}
    
    with open(DATA_FILE_PATH, 'r', encoding='utf-8') as f:
        return json.load(f)

def get_text(key, default=""):
    """Возвращает текст по ключу из data.json"""
    data = load_data()
    return data.get(key, default)

def get_formatted_text(section_prefix):
    """
    Формирует отформатированный текст для разделов.
    Например, для section_prefix='hero' вернет заголовок и подзаголовок.
    """
    data = load_data()
    if section_prefix == 'about':
        return (
            f"<b>{data.get('about_title', 'О нас')}</b>\n\n"
            f"{data.get('about_subtitle', '')}\n\n"
            f"🔹 <b>{data.get('feature_1_title', '')}</b>\n{data.get('feature_1_text', '')}\n\n"
            f"🔹 <b>{data.get('feature_2_title', '')}</b>\n{data.get('feature_2_text', '')}\n\n"
            f"🔹 <b>{data.get('feature_3_title', '')}</b>\n{data.get('feature_3_text', '')}"
        )
    elif section_prefix == 'services':
        return (
            f"<b>{data.get('steps_title', 'Этапы')}</b>\n"
            f"{data.get('steps_subtitle', '')}\n\n"
            f"1️⃣ <b>{data.get('step_1_title', '')}</b>\n{data.get('step_1_text', '')}\n\n"
            f"2️⃣ <b>{data.get('step_2_title', '')}</b>\n{data.get('step_2_text', '')}\n\n"
            f"3️⃣ <b>{data.get('step_3_title', '')}</b>\n{data.get('step_3_text', '')}"
        )
    elif section_prefix == 'pricing':
        return (
            f"<b>{data.get('pricing_title', 'Тарифы')}</b>\n"
            f"{data.get('pricing_subtitle', '')}\n\n"
            f"📋 <b>Шаблон</b>: {data.get('price_template', '')} ₽\n"
            f"— Качественный шаблон\n— Пример заполнения\n— Видео-инструкция\n\n"
            f"🔑 <b>Под ключ (ХИТ)</b>: {data.get('price_turnkey', '')} ₽\n"
            f"— Полная разработка\n— Анализ конкурентов\n— Исправление правок\n\n"
            f"👑 <b>VIP + Отчет</b>: {data.get('price_vip', '')} ₽\n"
            f"— Всё из 'Под ключ'\n— Ведение отчетности\n— Консультация бухгалтера"
        )
    elif section_prefix == 'faq':
        return (
            f"<b>{data.get('faq_title', 'FAQ')}</b>\n\n"
            f"❓ <b>{data.get('faq_1_q', '')}</b>\n{data.get('faq_1_a', '')}\n\n"
            f"❓ <b>{data.get('faq_2_q', '')}</b>\n{data.get('faq_2_a', '')}\n\n"
            f"❓ <b>{data.get('faq_3_q', '')}</b>\n{data.get('faq_3_a', '')}"
        )
    elif section_prefix == 'contact':
        return (
            f"<b>{data.get('contact_title', 'Контакты')}</b>\n"
            f"{data.get('contact_text', '')}\n\n"
            f"Telegram: {data.get('telegram', '')}\n"
            f"Email: {data.get('email', '')}\n"
            f"Телефон: {data.get('phone', '')}"
        )
    
    return "Информация отсутствует"
