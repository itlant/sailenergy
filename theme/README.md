# SAIL ENERGY — Локальный Docker-стек для WordPress

Локальное окружение для разработки темы SAIL ENERGY на WordPress с использованием Docker.

## 🐳 Сервисы

| Сервис       | Контейнер  | Порт  | Назначение          |
| ------------ | ---------- | ----- | ------------------- |
| **WordPress**| sail_wp    | 8080  | CMS + тема          |
| **MySQL**    | sail_db    | 3306  | База данных         |

## 📁 Структура
docker/
├── docker-compose.yml
├── wordpress/ # Ядро WP (создаётся Docker)
└── themes/
└── sailenergy-theme/ # Симлинк на project-root/theme/


🚀 Полный цикл разработки
bash
# 1. Запускаешь Docker (один раз)
cd docker
docker-compose up -d

# 2. Работаешь над темой в папке theme/
cd ../project-root/theme
# Редактируешь style.css, functions.php, index.php...

# 3. Обновляешь страницу в браузере
# http://localhost:8080 — видишь изменения!

# 4. Коммитишь изменения
git add .
git commit -m "Обновил стили"
git push
⚠️ Важные нюансы
Для статики (CSS, JS):
bash
# Ты работаешь в папке project-root/
cd project-root

# Запускаешь Gulp (следит за SCSS)
npm run dev

# Gulp компилирует style.scss → style.min.css
# Автоматически кладёт результат в theme/assets/css/style.min.css
# Docker видит этот файл → изменения применяются на сайте
Для PHP-файлов:
bash
# Просто редактируешь файлы в theme/
# Например, добавляешь новый шаблон single-regatta.php

# Docker сразу видит новый файл
# WordPress подхватывает его без перезагрузки
🎯 Итог
text
Gulp (компилирует) → theme/ → Docker (монтирует) → WordPress (показывает)
     ↑                    ↑                       ↑
  редактируешь          видишь              обновляешь
  SCSS/HTML            результат            браузер

yaml
volumes:
  - ../project-root/theme:/var/www/html/wp-content/themes/sailenergy-theme


⚙️ Переменные окружения
Переменная	Значение
MYSQL_DATABASE	sail_db
MYSQL_USER	sail_user
MYSQL_PASSWORD	sail_pass
MYSQL_ROOT_PASSWORD	root_pass
WORDPRESS_DB_HOST	db
WORDPRESS_DB_USER	sail_user
WORDPRESS_DB_PASSWORD	sail_pass
WORDPRESS_DB_NAME	sail_db
📄 Лицензия
Для внутреннего использования SAIL ENERGY.