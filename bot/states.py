from aiogram.fsm.state import StatesGroup, State

class ApplicationForm(StatesGroup):
    waiting_for_name = State()
    waiting_for_city = State()
    waiting_for_phone = State()
    waiting_for_method = State()
    waiting_for_comment = State()
