from aiogram import Router, F, types
from aiogram.filters import Command
from aiogram.fsm.context import FSMContext
from bot.content_loader import get_formatted_text
from bot.keyboards import get_main_menu, get_contact_method_keyboard, get_cancel_keyboard
from bot.states import ApplicationForm
from bot.config import ADMIN_ID

router = Router()

@router.message(Command("start"))
async def cmd_start(message: types.Message):
    await message.answer(
        "👋 Привет! Я бот Анастасии Савончик.\n"
        "Я помогу вам узнать о социальном контракте и оформить заявку на бизнес-план.",
        reply_markup=get_main_menu()
    )

@router.message(F.text == "❌ Отмена")
async def process_cancel(message: types.Message, state: FSMContext):
    current_state = await state.get_state()
    if current_state is None:
        await message.answer("Нет активной заявки для отмены.", reply_markup=get_main_menu())
        return

    await state.clear()
    await message.answer("Заявка отменена.", reply_markup=get_main_menu())

# --- Menu Handlers ---
@router.message(F.text == "👋 О нас")
async def menu_about(message: types.Message):
    await message.answer(get_formatted_text("about"), parse_mode="HTML")

@router.message(F.text == "🚀 Этапы")
async def menu_services(message: types.Message):
    await message.answer(get_formatted_text("services"), parse_mode="HTML")

@router.message(F.text == "💰 Тарифы")
async def menu_pricing(message: types.Message):
    await message.answer(get_formatted_text("pricing"), parse_mode="HTML")

@router.message(F.text == "❓ FAQ")
async def menu_faq(message: types.Message):
    await message.answer(get_formatted_text("faq"), parse_mode="HTML")

@router.message(F.text == "📞 Контакты")
async def menu_contact(message: types.Message):
    await message.answer(get_formatted_text("contact"), parse_mode="HTML")

# --- Form Handlers ---
@router.message(F.text == "📝 Оставить заявку")
async def start_form(message: types.Message, state: FSMContext):
    await state.set_state(ApplicationForm.waiting_for_name)
    await message.answer("Как к вам обращаться?", reply_markup=get_cancel_keyboard())

@router.message(ApplicationForm.waiting_for_name)
async def process_name(message: types.Message, state: FSMContext):
    await state.update_data(name=message.text)
    await state.set_state(ApplicationForm.waiting_for_city)
    await message.answer("Из какого вы города?")

@router.message(ApplicationForm.waiting_for_city)
async def process_city(message: types.Message, state: FSMContext):
    await state.update_data(city=message.text)
    await state.set_state(ApplicationForm.waiting_for_phone)
    await message.answer("Напишите ваш номер телефона (+7...)")

@router.message(ApplicationForm.waiting_for_phone)
async def process_phone(message: types.Message, state: FSMContext):
    await state.update_data(phone=message.text)
    await state.set_state(ApplicationForm.waiting_for_method)
    await message.answer("Как с вами удобнее связаться?", reply_markup=get_contact_method_keyboard())

@router.message(ApplicationForm.waiting_for_method)
async def process_method(message: types.Message, state: FSMContext):
    if message.text not in ["Telegram", "WhatsApp", "Позвонить"]:
        await message.answer("Пожалуйста, выберите вариант из кнопок.")
        return
    await state.update_data(method=message.text)
    await state.set_state(ApplicationForm.waiting_for_comment)
    await message.answer("Напишите комментарий или интересующий тариф:", reply_markup=get_cancel_keyboard())

@router.message(ApplicationForm.waiting_for_comment)
async def process_comment(message: types.Message, state: FSMContext):
    data = await state.get_data()
    comment = message.text
    
    # Формируем заявку
    application_text = (
        "🔔 <b>Новая заявка через бот!</b>\n\n"
        f"👤 Имя: {data['name']}\n"
        f"🌍 Город: {data['city']}\n"
        f"📱 Телефон: {data['phone']}\n"
        f"💬 Связь: {data['method']}\n"
        f"📝 Комментарий: {comment}\n"
        f"🔗 Пользователь: <a href='tg://user?id={message.from_user.id}'>{message.from_user.full_name}</a>"
    )

    # Отправляем админу
    if ADMIN_ID:
        try:
            await message.bot.send_message(ADMIN_ID, application_text, parse_mode="HTML")
        except Exception as e:
            await message.answer(f"Ошибка отправки администратору: {e}")
    
    await message.answer("✅ Ваша заявка принята! Мы свяжемся с вами в ближайшее время.", reply_markup=get_main_menu())
    await state.clear()
