# Navidad Pichilemu

Aplicación Laravel 11 con panel de administración Filament 3, Livewire (Volt), Vite y Tailwind CSS.

## Stack tecnológico

| Capa | Tecnología |
|------|------------|
| Backend | PHP 8.2+, Laravel 11 |
| Admin | Filament 3 |
| Frontend | Vite, Tailwind CSS, Blade, Livewire (Volt) |
| Base de datos | SQLite (por defecto) |
| Testing | Pest |

## Requisitos

- PHP 8.2+
- Composer 2.x
- Bun (para compilación de assets)

---

## Desarrollo

### Configuración inicial

```bash
# Clonar repositorio
git clone https://github.com/munipichilemu/navidad.git navidad.pichilemu
cd navidad.pichilemu

# Instalar dependencias PHP
composer install

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Sembrar sectores iniciales
php artisan db:seed --class=SectorSeeder
```

### Ejecutar el proyecto

Con **Laravel Herd**, el proyecto estará disponible automáticamente en `http://navidad.pichilemu.test` (o el dominio configurado).

### Compilar assets (frontend)

Solo es necesario cuando se modifiquen archivos CSS/JS:

```bash
# Instalar dependencias Node/Bun
bun install

# Servidor de desarrollo con hot reload
bun run dev
```

---

## Producción

```bash
# Instalar dependencias (sin dev)
composer install --no-dev --optimize-autoloader

# Compilar assets
bun install
bun run build

# Cachear configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Enlazar storage (si se usan archivos públicos)
php artisan storage:link
```

Configurar en `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com
```

---

## Recursos

- [Laravel](https://laravel.com/docs)
- [Filament](https://filamentphp.com/docs)
- [Livewire](https://livewire.laravel.com)
