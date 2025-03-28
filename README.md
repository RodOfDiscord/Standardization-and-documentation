# Coursework Project  

## Опис  

Цей проєкт реалізує систему для роботи з фільмами та коментарями, що включає фронтенд і бекенд частини. Він надає API для отримання інформації про фільми, додавання коментарів та інші можливості.  

## Функціональність  

-   **API для роботи з фільмами**: Отримання деталей фільму за його ID та додавання коментарів.  
-   **Frontend**: Сторінка для перегляду фільмів та коментарів.  
-   **Swagger**: Документація для API, включаючи два основних виклики.  
-   **Storybook**: Опис компонентів з варіаціями властивостей.  

## Структура Проєкту  
/cms                     
- ├── /config             # Configuration files
- ├── /pages              # Application pages
- ├── /utils              # Utility functions
- ├── /views              # View components (if needed)
- ├── /core               # Core functionality (e.g., services, helpers)
- ├── /models             # Database models
- ├── /controllers        # Controllers for routing and logic
- ├── /docs               # Documentation files (e.g., user guide)
- ├── swagger.yaml        # Swagger documentation
- ├── .gitignore          # Git ignore file
- ├── README.md           # Project description
- ├── LICENSE             # License file
- └── package.json        # Project dependencies
- ├── license.json        # confirmation that the MIT license is indeed installed


## Інсталяція та налаштування  

1.  **Клонувати репозиторій:**  

    ```bash  
    git clone https://github.com/VieshchykovOleg/Standardization-and-documentation  
    cd cms  
    ```  
2.  **Встановити залежності:**  

    *   Для PHP:  

        ```bash  
        composer install  
        ```  
    *   Для Swagger документації: Щоб додати необхідну бібліотеку для генерації Swagger документації, виконайте команду  

        ```bash  
        composer require zircote/swagger-php
 
        ```  
3.  **Налаштування бази даних (якщо використовуєте MySQL):**  

    *   Створіть базу даних.  
    *   Налаштуйте підключення до бази в `config/db.php`.  
4.  **Запустіть сервер:**  

    *   Для PHP:  

        ```bash  
        php -S localhost:8000  
        ```  
   

## Основні Команди  

*   Запуск проєкту на локальному сервері:  

    ```bash  
    php -S localhost:8000  
    ```

## Ліцензія  

Проєкт ліцензований під MIT License.  

## Авторство  

*   Автор: Олег Миколайович Вєщиков  
*   Контакт: ipz222_vom@student.ztu.edu.ua 
*   GitHub: <https://github.com/VieshchykovOleg>  

## Документація  

*   Swagger: [Документація API (локальний доступ)](http://localhost:8000/swagger)  
*   Storybook: Компоненти UI  

## Примітки  

*   Проєкт працює на локальному сервері (localhost:8000).  
*   Для локальної документації Swagger запускайте docker або використовуйте інші інструменти для тестування API.  