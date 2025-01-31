# Delivery Test Task

## Установка и запуск

### 1. Клонирование репозитория
```bash
git clone https://github.com/void-environment/delivety-test-task.git
cd delivery-test-task
```

### 2. Переменные окружения

Скопировать `.env.example` в `.env`:
```bash
cp .env.example .env
```

### 3. Запуск контейнеров

```bash
docker-compose up -d --build
```

### 4. Генерация ключа

```bash
docker-compose exec app php artisan key:generate
```

### 5. Миграции и сиды
```bash
docker-compose exec app php artisan migrate --seed
```

