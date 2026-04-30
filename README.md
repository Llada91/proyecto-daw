# Forja de Mundos

Plataforma web para gestionar partidas de rol de mesa. Permite a los jugadores crear personajes, unirse a partidas y comunicarse en tiempo real a través de una sala de juego con chat y tiradas de dados.

## Tecnologías

- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Blade + CSS propio + Vite
- **Autenticación:** Laravel Breeze
- **Base de datos:** MySQL / SQLite

## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL o SQLite

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repo>
cd proyecto

# 2. Instalar dependencias
composer install
npm install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar la base de datos en .env
# DB_CONNECTION=mysql
# DB_DATABASE=proyecto_daw
# DB_USERNAME=...
# DB_PASSWORD=...

# 5. Ejecutar migraciones
php artisan migrate

# 6. Crear enlace de almacenamiento (para imágenes)
php artisan storage:link

# 7. Compilar assets y arrancar
npm run dev
php artisan serve
```

## Funcionalidades

### Usuarios
- Registro, login y verificación de email
- Edición de perfil y eliminación de cuenta
- Dos roles: **usuario** y **admin**

### Partidas
- Crear, editar y eliminar partidas (solo el creador)
- Cada partida tiene un director (creador) y jugadores con sus personajes
- El director puede invitar o expulsar personajes de la partida

### Personajes
- Cada usuario crea sus propias fichas de personaje
- Imagen del personaje (almacenada en `storage/app/public/personajes`)
- Los personajes se pueden asignar a una o varias partidas

### Sala de juego
- Acceso restringido: solo el director y los jugadores con personaje en la partida
- Chat de mensajes en tiempo real (con recarga)
- Tiradas de dados: d4, d6, d8, d10, d12, d20, d100
- Selección de personaje activo cuando el jugador tiene varios en la misma partida
- Historial de los últimos 50 mensajes

### Panel de administración
- Acceso exclusivo para usuarios con rol `admin`
- Listado y eliminación de usuarios, partidas y personajes

## Estructura de la ficha de personaje

El campo `datos` de la tabla `personajes` es un JSON con los siguientes campos:

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `nombre` | string | Nombre del personaje (obligatorio) |
| `raza` | string | Raza (Humano, Elfo, Enano...) |
| `clase` | string | Clase (Guerrero, Mago, Pícaro...) |
| `nivel` | integer | Nivel del personaje (1-20) |
| `trasfondo` | string | Trasfondo (Noble, Soldado, Sabio...) |
| `puntos_vida` | integer | Puntos de vida máximos |
| `clase_armadura` | integer | Clase de armadura |
| `descripcion` | string | Historia del personaje |
| `fuerza` | integer | Característica Fuerza (1-20) |
| `destreza` | integer | Característica Destreza (1-20) |
| `constitucion` | integer | Característica Constitución (1-20) |
| `inteligencia` | integer | Característica Inteligencia (1-20) |
| `sabiduria` | integer | Característica Sabiduría (1-20) |
| `carisma` | integer | Característica Carisma (1-20) |

## Roles y permisos

| Acción | Usuario | Admin |
|--------|---------|-------|
| Crear/editar/eliminar sus partidas | ✓ | ✓ |
| Crear/editar/eliminar sus personajes | ✓ | ✓ |
| Acceder a la sala de juego | ✓ | ✓ |
| Eliminar cualquier usuario | — | ✓ |
| Eliminar cualquier partida | — | ✓ |
| Eliminar cualquier personaje | — | ✓ |

Para asignar el rol admin, cambiar el campo `rol` a `admin` directamente en la base de datos.
