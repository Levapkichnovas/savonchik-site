import asyncio
import logging
import sys

from aiogram import Bot, Dispatcher
from bot.config import BOT_TOKEN
from bot.handlers import router

async def main():
    # Настройка логирования
    logging.basicConfig(level=logging.INFO, stream=sys.stdout)
    
    # Инициализация бота и диспетчера
    bot = Bot(token=BOT_TOKEN)
    dp = Dispatcher()
    
    # Регистрация роутеров
    dp.include_router(router)
    
    # Удаление вебхука перед поллингом (решает ошибку TelegramConflictError)
    await bot.delete_webhook(drop_pending_updates=True)

    # Запуск поллинга
    try:
        await dp.start_polling(bot)
    except Exception as e:
        logging.error(f"Ошибка при запуске бота: {e}")

if __name__ == "__main__":
    asyncio.run(main())
