# TMDB Laravel Project

Projekt Laravel działający na Dockerze, służący do pobierania danych filmów, seriali i gatunków z TMDB API oraz wyświetlania listy filmów w aplikacji (z użyciem REST API oraz Livewire).

## URUCHOMIENIE (Docker):

1. Sklonuj repo i przejdź do katalogu:
   ```bash
   git clone https://github.com/michal1337k/recruit-tmdb-app
   cd tmdb-laravel
   ```

3. Skopiuj .env i ustaw dane (DB, TMDB API):
   ```bash
   cp .env.example .env
   php artisan key:generate
    ```

5. Uruchom Docker:
   ```bash
   docker-compose up -d
   ```

6. Migracje i pobranie danych:
   ```bash
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan tmdb:fetch
   ```

8. Strona dostępna pod:
   ```bash
   http://localhost:8000
   ```
   Livewire:
   ```bash
   http://localhost:8000/movies-list
   ```

---

## ENDPOINTY API:

| Ścieżka    | Opis |
| -------- | ------- |
| GET /api/movies | lista filmów (paginacja) |
| GET /api/movies/{id} | szczegóły filmu |
| GET /api/series | lista seriali (paginacja) |
| GET /api/series/{id} | szczegóły serialu) |
| GET /api/genres | lista gatunków (paginacja) |
| GET /api/genres/{id} | szczegóły gatunku|

--- 
**PARAMETRY:**

- *Accept-Language*: en / pl / de
- *per_page*: liczba elementów na stronę (dla paginacji)

--- 
**PRZYKŁAD:**

```bash
GET http://localhost:8000/api/movies?per_page=20
Header: Accept-Language: en
```
