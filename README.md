https://www.work.ua/jobs/4721848/

https://docs.google.com/document/d/1kclB8B4Zuh8-4AZ-_pREPAM--tYq-OXDUjTE66NRIiE/edit

Examples of working with Yii2 framework
1. Request:
	- processing
	- customization
	- beforeRequest
	- work with files (upload, download)
2. Controller:
	- CRUD methods
	- behaviors
	- access
3. Model:
	- behaviors and events
	- relations
	- rules and custom rules
4. View:
	- assets and bundles
	- layouts
	- themes
	- widgets
		- GridView
		- ListView
		- Pjax
		- filter
		- sorting
		- load more (dynamic loading)
		- custom widgets
5. Behaviors:
	- extension of models
	- pre or post data processing
6. Modules
7. Will be a plus:
	- example of multilingual implementation
	- photo processing example
	- API implementation example
	- task queue implementation example
	- example of working with time zones (saving and output in accordance with the format and time zone)



Що розробляємо: Система керування проектами з конвертації даних
Ціль: автоматизувати та систематизувати роботу із конвертації даних між різними системами
1. Керування переліком проектів (CRUD)
    оптимиістичне блокування
2. Керування перліком задач (CRUD)
    оптимиістичне блокування
3. Керування переліком клієнтів(CRUD)
4. Керування переліком користувачів (CRUD), RBAC
5. Коментарі
6. Повідомлення (уведомления)
7. Файли
8. Лог операцій
9. Статичні сторінки / інструкції



Таблиця: Проект (project)
    ід
    назва
    опис - підключити TinyMCE
    статус
    ід користувача, який створив проект
    дата створення
    дата зміни
    версія
Ключ Проект-Задачи
Ключ Проект-Етапи

Таблиця зв'язку мені-то-мені: Проект-Користувачі(Відповідальні особи) - (ref_project_user)
    ід
    ід проекту
    ід користувача
    роль зв'язку
class project {
    public function getUsers(){
        return $this->hasMany(Item::class, ['id' => 'user_id'])
            ->via('ref_project_user');
    }
}


Таблиця: Задача (task)
    ід
    ід проекту
    ід відповідального
    статус
    назва
    опис
    дата створення
    дата зміни
    версія
Ключ Задача-Користувачі
Ключ Задача-Коментарії
    

Таблиця: Організація(organization)
    ід
    назва повна
    назва скорочена
    опис
    основна контактна особа
    дата створення
    дата зміни
    версія
Ключ Організація-Користувачі
Ключ Організація-Проекти

    
Таблиця: Користувач (user)
    ід
    ПІБ
    ід організації
    посада
    емейл
    телефон
    аватарка
    коментар
    дата створення
    дата зміни
    версія
Ключ Користувач-Проекти
Ключ Користувач-Задачі
Ключ Користувач-Повідомлення


Таблиця: Коментар (коментарі можливо додавати до проекту та задачі) (comment)
    ід
    ід користувача
    ід проекту
    ід задачі
    текст
    дата створення
    дата корегування
    версія
Ключ Комментарій-Файли


Таблиця: Файл (можна додавати до проекту та задачі) (file)
    ід
    ід користувача
    назва файлу
    тип файлу
    розмір файлу
    місце зберігання
    тип об'єкту (проект/задача)
    ід об'єкту
    
    

Таблиця: Лог операцій (operation_log)
    ід
    вид операції
    опис операції
    ід користувача
    ід проекту
    ід задачі
    ід коментаря
    ід файлу
    дата




<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![build](https://github.com/yiisoft/yii2-app-advanced/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-advanced/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
