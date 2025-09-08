## Aval24 Assignment
REST API для управления клиентами, реализованный на **Laravel** с использованием **DDD** и **Clean Architecture**.

#### [Техническое задание (Google Drive)](https://drive.google.com/file/d/1-7xVZBMM7WYj3xgyrKSLDTWSNSps-gin/view)

### Архитектура
- **Framework:** Laravel
- **База данных:** SQLite
- **Паттерны:** Domain-Driven Design (DDD), Clean Architecture, SOLID
- **Слои:**
    - **Domain** — сущности, value objects, интерфейсы репозиториев
    - **Application** — DTO и use-case-ы
    - **Infrastructure** — адаптеры для Eloquent, ID генерация
    - **Presentation** — контроллеры, запросы, маршруты (HTTP API)

### Запуск проекта

#### 1. Установить зависимости
```bash
composer install
```

#### 2. Установить Sail и запустить контейнер
```bash
./vendor/bin/sail install
./vendor/bin/sail up
```

#### 3. Выполнить миграции
```bash
./vendor/bin/sail artisan migrate
```

### API будет доступен по адресу:
http://localhost:80

### Тестирование

Тесты написаны на Pest.

```bash
./vendor/bin/sail test
```

### Документация API
- Postman Collection: `./postman_collection.json`
- Содержит все эндпоинты, пример запросов и ответов.

Импортируй коллекцию в Postman и используй её для тестирования API.
