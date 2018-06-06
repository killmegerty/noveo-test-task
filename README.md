# Пререквизиты

Из корня проекта, установка зависимостей
```sh
$ composer install
$ npm install
```
Дать полные права на кеш\лог папки для ларавела
```sh
$ sudo chmod 777 -R {storage,bootstrap/cache}
```
Создание БД
```sh
mysql> CREATE DATABASE minenko_konstantin DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
mysql> GRANT ALL PRIVILEGES ON minenko_konstantin.* TO minenko_konstantin@localhost IDENTIFIED BY 'minenko_konstantin';
```
Миграции, сиды, из корня проекта
```sh
$ php artisan migrate:fresh --seed
```

# Комментарии по проекту
Из .gitignore .env я убрал, он есть в проекте. Сделал специально, чтобы ускорить настройку окружения.

Запуск тестов
```sh
$ vendor/bin/phpunit
```

#Роуты

GET /api/users - list of users
GET /api/users/{id} - user info
POST /api/users - create user
PATCH /api/users/{id} - update user

GET /api/groups - list of groups
GET /api/groups/{id} - group info
POST /api/groups - create group
PATCH /api/groups/{id} - update group
