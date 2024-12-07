
Как запустить
docker-compose up -d

npm install  
npm run dev

docker exec -it testcase_app bash
php artisan migrate

дальше в Postman

Регистрация
http://localhost:8876/api/register POST

{
"name": "Test User",
"email": "testuser@gmail.com",
"password": "password123",
"password_confirmation": "password123"
}

в ответе будет токен, вставляем его в Bearer Token

Добавление товара
http://localhost:8876/api/products POST
{
"title": "Title example2",
"description": "bla bla bla bla bla bla bla",
"price": 120.34,
"category": "Any category"
}


Отображение товара
http://localhost:8876/api/products GET

Для фильтрации продуктов по категории пишем атрибут "category": "Any category"
Для фильтрации продуктов по цене пишем атрибут "min_price" или "max_price"
Для фильтрации по популярности пишем "popularity": "desc" или "asc", популярность считается по кол-ву комментариев
Пример
[
{
"id": 1,
"title": "Title example1",
"description": "bla bla bla bla bla bla bl",
"price": "11.00",
"category": "Any category",
"image": null,
"created_at": "2024-12-07T12:59:01.000000Z",
"updated_at": "2024-12-07T12:59:01.000000Z"
},
{
"id": 2,
"title": "Title example2",
"description": "bla bla bla bla bla bla blzxczxczxcz",
"price": "110.00",
"category": "Any category",
"image": null,
"created_at": "2024-12-07T12:59:11.000000Z",
"updated_at": "2024-12-07T12:59:11.000000Z"
},
{
"id": 3,
"title": "Title example67",
"description": "bla bla bla blzxczxczxc123z",
"price": "55.00",
"category": "Bad category",
"image": null,
"created_at": "2024-12-07T12:59:39.000000Z",
"updated_at": "2024-12-07T12:59:39.000000Z"
}
]



Добавление комментария
http://localhost:8876/api/comments POST
{
"text": "another bad or good review",
"product_id": "1"
}

Покупка
http://localhost:8876/api/purchases POST

{
"products": [
{ "id": 1, "quantity": 2 },
{ "id": 2, "quantity": 1 }
]
}

Для просмотра своей истории покупок нужно получить авторизоватся и перейти по
http://localhost:8876/api/purchases GET

Покупки отображаются от новых к старым




ТЗ

Технологии:
•              PHP (Laravel Framework)
•              Docker
•              MariaDB

Описание задачи:
Создать веб-приложение на Laravel с использованием Docker и базы данных MariaDB, которое включает в себя следующие функциональные возможности:
1.         Страница авторизации:
◦        Реализовать регистрацию и авторизацию пользователей.

2.         API:
Создать RESTful API для взаимодействия с приложением.
3.
a. API для товаров:
◦        Реализовать следующие операции с товарами:
▪        Создание нового товара.
▪        Получение списка товаров.
▪        Обновление информации о товаре.
▪        Удаление товара.
◦        Поля товара могут включать: название, описание, цену, категорию, изображение и т.д.

4.        b. Комментарии к товарам:
◦        Пользователи могут добавлять комментарии к товарам.
◦        Реализовать возможность просмотра, добавления и удаления комментариев.
◦        Только авторизованные пользователи могут оставлять комментарии.

5.        c. Фильтры:
◦        Реализовать фильтрацию товаров по различным параметрам:
▪        Категория.
▪        Ценовой диапазон.
▪        Популярность и т.д.

5.        d. История покупок:
◦        Реализовать возможность для пользователей просматривать историю своих покупок.
◦        Сохранять информацию о покупке: товары, дата, сумма и т.д.





Требования к выполнению:
•             Docker:
◦        Проект должен быть развернут с использованием Docker.
◦        Предоставить docker-compose.yml для развёртывания приложения и базы данных.

•             База данных:
◦        Использовать MariaDB для хранения данных.
◦        Предоставить миграции для создания необходимых таблиц в базе данных.

•             Код и структура проекта:
◦        Соблюдать стандарты Laravel.
◦        Использовать принципы ООП и паттерны проектирования где это уместно.
◦        Код должен быть чистым, хорошо структурированным и легко читаемым.

•             Документация:
◦        Предоставить файл README.md с инструкциями по запуску приложения.

