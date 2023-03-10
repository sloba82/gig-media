
## GIG MEDIA test

- .env is provided in root of the project, please change credentials to yours (DB_DATABASE=, DB_USERNAME=, DB_PASSWORD=).
- Also postmen collection is provided in root of the project.


Clone the repo and please run next commands in your terminal.

```sh
- composer install
- php artisan serve
- php artisan migrate --seed
```

Project should be found on route http://127.0.0.1:8000,

```sh
project routes
- GET http://127.0.0.1:8000/api/posts
- GET http://127.0.0.1:8000/api/comments
- DELETE http://127.0.0.1:8000/api/comments/{id}
- DELETE http://127.0.0.1:8000/api/posts/{id}
- POST http://127.0.0.1:8000/api/comments
```


