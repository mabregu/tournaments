## Torneo de Tenis

### Para ejecutar el proyecto

1. Clonar el repositorio
2. Ejecutar el comando `composer install` para instalar las dependencias
3. Ejecutar el comando `php artisan migrate:fresh --seed` para crear la base de datos y poblarla con datos de prueba
4. Ejecutar el comando `php artisan serve` para levantar el servidor
5. Rutas disponibles:
    - ruta para ver la documentación de la API: `http://localhost:8000/api/documentation`
    - `http://localhost:8000/api/players` para ver todos los jugadores
    - `http://localhost:8000/api/players/{id}` para ver un jugador en particular
    - `http://localhost:8000/api/tournaments` para ver todos los torneos
    - `http://localhost:8000/api/tournaments/{id}` para ver un torneo en particular
    - `http://localhost:8000/api/tournaments/gender/{gender}` para ver todos los torneos de un género en particular
    - `http://localhost:8000/api/tournaments/date/{date}` para ver todos los torneos de una fecha en particular

    - rutas por POST para crear jugadores y torneos:

    - `http://localhost:8000/api/players/` para crear un jugador
    - `http://localhost:8000/api/tournaments/create` para crear un torneo

### Para ejecutar los tests

`php artisan test`

