# Имя контейнера/проекта
PROJECT_NAME = laravel_app

# Docker-compose файл
COMPOSE = docker compose -f docker-compose.yml

# Контейнер приложения (php-fpm)
APP_CONTAINER = php-fpm

# Контейнер базы данных (MySQL)
DB_CONTAINER = $(PROJECT_NAME)_db_1

# ------------------------------
# Создание .env если его нет
# ------------------------------
env:
	@if [ ! -f .env ]; then \
		cp .env.example .env; \
		echo ".env файл создан из .env.example"; \
	else \
		echo ".env файл уже существует"; \
	fi


# ------------------------------
# Создание папок storage и bootstrap/cache
# ------------------------------
folders:
	@$(COMPOSE) exec $(APP_CONTAINER) bash -c "\
		mkdir -p storage/framework/{views,cache,sessions,testing} bootstrap/cache && \
		chown -R www-data:www-data storage bootstrap/cache && \
		chmod -R 775 storage bootstrap/cache \
	"
	@echo "Папки storage и bootstrap/cache созданы и права установлены внутри контейнера"

# ------------------------------
# Полная сборка и запуск проекта
# ------------------------------
setup:
	@$(MAKE) env
	@$(MAKE) folders
	@$(MAKE) build
	@$(MAKE) up
	@$(MAKE) composer-install
	@$(MAKE) artisan-key:generate
	@$(MAKE) artisan-migrate
	@$(MAKE) cache-clear
	@echo "Проект успешно развернут! Доступен на http://localhost:8080"
# ------------------------------
# Сборка и запуск
# ------------------------------

build:
	@$(COMPOSE) build

up:
	@$(COMPOSE) up -d

down:
	@$(COMPOSE) down

restart: down up

# ------------------------------
# Composer / Artisan
# ------------------------------

composer-install:
	@$(COMPOSE) exec php-cli composer install

composer-update:
	@$(COMPOSE) exec php-cli composer update

artisan-%:
	@$(COMPOSE) exec php-cli php artisan $*

# ------------------------------
# Миграции и сиды
# ------------------------------

migrate:
	@$(COMPOSE) exec php-cli php artisan migrate

migrate-fresh:
	@$(COMPOSE) exec php-cli php artisan migrate:fresh

db-seed:
	@$(COMPOSE) exec php-cli php artisan db:seed

# ------------------------------
# Очистка кэша
# ------------------------------

cache-clear:
	@$(COMPOSE) exec php-cli php artisan cache:clear
	@$(COMPOSE) exec php-cli php artisan config:clear
	@$(COMPOSE) exec php-cli php artisan route:clear
	@$(COMPOSE) exec php-cli php artisan view:clear

# ------------------------------
# Логи
# ------------------------------

logs:
	@$(COMPOSE) logs -f

# ------------------------------
# Bash в контейнере
# ------------------------------

bash:
	@$(COMPOSE) exec php-cli bash
