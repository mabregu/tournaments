## Torneo de Tenis

### Objetivo

● La modalidad del torneo es por eliminación directa*
● Puede asumir por simplicidad que la cantidad de jugadores es potencia de 2.
● El torneo puede ser Femenino o Masculino
● Cada jugador tiene un nombre y un nivel de habilidad (entre 0 y 100)
● En un enfrentamiento entre dos jugadores influyen el nivel de habilidad y la suerte para
decidir al ganador del mismo. Es su decisión de diseño de qué forma incide la suerte en
este enfrentamiento.
● En el torneo masculino, se deben considerar la fuerza y la velocidad de desplazamiento
como parámetros adicionales al momento de calcular al ganador.
● En el torneo femenino, se debe considerar el tiempo de reacción como un parámetro
adicional al momento de calcular al ganador.
● No existen los empates
● Se requiere que a partir de una lista de jugadores se simule el torneo y se obtenga
como output al ganador del mismo.
● Se recomienda realizar la solución en su IDE preferido.
● Se valorarán las buenas prácticas de Programación Orientada a Objetos.
● Puede definir por su parte cualquier cuestión que considere que no es aclarada. Puede
agregar las aclaraciones que considere en la entrega del ejercicio
● Cualquier extra que aporte será bienvenido
● Se prefiere el modelado en capas o arquitecturas limpias (Clean Architecture)
● Se prefiere la entrega de la solución mediante un sistema de versionado
(github/bitbucket/etc)

* La eliminación directa, es un sistema en torneos que consiste en que el perdedor de un
encuentro queda inmediatamente eliminado de la competición, mientras que el ganador
avanza a la siguiente fase. Se van jugando rondas y en cada una de ellas se elimina la
mitad de participantes hasta dejar un único competidor que se corona como campeón.

* Importante: Se prestará especial énfasis en el correcto modelado y aplicación de buenas
prácticas de la programación orientada a objetos.

### Consideraciones

● El ejercicio debe ser entregado en un repositorio de git (github, bitbucket, etc) y debe

### Para ejecutar el proyecto

1. Clonar el repositorio
2. Ejecutar el comando `composer install` para instalar las dependencias
3. Ejecutar el comando `php artisan migrate:fresh --seed` para crear la base de datos y poblarla con datos de prueba
4. Ejecutar el comando `php artisan serve` para levantar el servidor
5. Abrir el navegador
