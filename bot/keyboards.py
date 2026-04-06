from aiogram.types import ReplyKeyboardMarkup, KeyboardButton, InlineKeyboardMarkup, InlineKeyboardButton

def get_main_menu():
    """Главное меню бота"""
    return ReplyKeyboardMarkup(
        keyboard=[
            [
                KeyboardButton(text="👋 О нас"),
                KeyboardButton(text="🚀 Этапы")
            ],
            [
                KeyboardButton(text="💰 Тарифы"),
                KeyboardButton(text="❓ FAQ")
            ],
            [
                KeyboardButton(text="📝 Оставить заявку"),
                KeyboardButton(text="📞 Контакты")
            ]
        ],
        resize_keyboard=True,
        input_field_placeholder="Выберите пункт меню..."
    )

def get_contact_method_keyboard():
    """Клавиатура для выбора способа связи"""
    return ReplyKeyboardMarkup(
        keyboard=[
            [KeyboardButton(text="Telegram"), KeyboardButton(text="WhatsApp")],
            [KeyboardButton(text="Позвонить")],
            [KeyboardButton(text="❌ Отмена")]
        ],
        resize_keyboard=True,
        one_time_keyboard=True
    )

def get_cancel_keyboard():
    return ReplyKeyboardMarkup(
        keyboard=[[KeyboardButton(text="❌ Отмена")]],
        resize_keyboard=True
    )
