# Инструкция по запуску проекта

## Требования
- [Docker](https://www.docker.com/get-started)

## Запуск проекта
Собираем контейнер командой в папке проекта `docker-compose up -d`

Бекап БД должен автоматически импортироваться при сборке контейнера


## MySQL

- **Доступ:** [http://localhost:8080/](http://localhost:8080/)
- **Данные для авторизации:**  
  Логин: `user`  
  Пароль: `userpass`
- **Запрос для выборки активных мотоциклов:**
   ```sql
   SELECT
     t.name AS type,
     COUNT(m.id) AS active_motorcycles
   FROM types t
   LEFT JOIN motorcycles m ON t.id = m.type_id AND m.discontinued = 0
   GROUP BY t.id, t.name;


## Файловый менеджер

- **Доступ:** [http://localhost/file_manager/](http://localhost/file_manager/)

## Форма авторизации

- **Доступ:** [http://localhost/auth/](http://localhost/auth/)