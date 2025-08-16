<div align="center">
  <img src="https://placehold.co/600x200/4F46E5/FFFFFF?text=PicoFrame+CLI" alt="PicoFrame Banner" width="100%">
  
  <p>
    <a href="https://opensource.org/licenses/MIT">
      <img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="Licencia MIT">
    </a>
    <img src="https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php" alt="PHP 8.0+">
    <img src="https://img.shields.io/badge/CLI-Powered-success" alt="CLI Integrado">
    <img src="https://img.shields.io/github/stars/ErickTenor/picoframe?style=social" alt="GitHub Stars">
  </p>
</div>

**Una visión minimalista hacia el futuro del desarrollo web**  

PicoFrame es un micro-framework ligero construido en **PHP**, con soporte para **Twig** y una pizca de **JavaScript** y **SCSS**.  
Optimizado para soltar código innecesario, potenciar la eficiencia y preguntarse:  
¿por qué complicar lo simple?

---

## 🚀 Instalación

### Opción 1: Instalar con Composer (recomendado)

```bash
composer require tenor/picoframe
```

### Opción 2: Crear un nuevo proyecto

```bash
composer create-project tenor/picoframe nombre-de-tu-proyecto
cd nombre-de-tu-proyecto
```

Copia el archivo `.env.example` a `.env` y ajusta las variables según tu entorno.

```bash
cp .env.example .env
```

Instala dependencias y compila assets:

```bash
composer install
npm install
npm run build
```

Ejecuta el servidor embebido de PHP:

```bash
php pico serve
```

Accede en tu navegador a `http://localhost:8000`.

---

### Comndo lista 

```bash
php pico
```
---

## 📖 Ejemplo rápido

### Controlador básico

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use PicoFrame\App;

$app = new App();

$app->get('/', function () {
    return $this->render('home.twig', [
        'titulo' => 'Bienvenido a PicoFrame',
        'mensaje' => 'Framework minimalista, simple y veloz 🚀'
    ]);
});

$app->run();
```

**home.twig**

```twig
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>{{ titulo }}</title>
</head>
<body>
  <h1>{{ mensaje }}</h1>
</body>
</html>
```

---

## 🛠️ Tecnologías usadas

- **PHP** (~78 %)  
- **Twig** (~16 %)  
- **Hack** (~3 %)  
- **JavaScript** (~2 %)  
- **SCSS** (~0.4 %)  

---

## 📚 Documentación del Framework

### 🔹 Rutas

```php
$app->get('/hola/{nombre}', function ($nombre) {
    return $this->render('saludo.twig', [
        'nom' => $nombre
    ]);
});
```

**saludo.twig**

```twig
<h2>Hola, {{ nom }}. ¿Y ahora qué?</h2>
```

### 🔹 Motor de Plantillas  
- Usa **Twig** para procesar vistas.
- `render($vista, array $datos)` busca la plantilla en `resources/views/`.

### 🔹 Configuración  
- `.env` permite definir parámetros como `APP_ENV`, `DB_HOST`, etc.
- Helper sugerido: `config('VARIABLE')`.

### 🔹 Assets  
- `public/` contiene archivos compilados de SCSS y JS con `npm run build`.

---

## 🗺️ Roadmap Futuro

| Funcionalidad | Estado |
|---------------|---------|
| Middleware    | En diseño |
| CLI integrada | Planeado |
| Cache Twig    | Planeado |
| ORM minimal   | En exploración |
| Tests con Pest | Planeado |

---

## 🤝 Cómo contribuir

1. Haz un fork.
2. Crea tu rama: `git checkout -b feature/tu-idea-genial`.
3. Haz commits cortos y claros 😉.
4. Envía un pull request.

---

## 📜 Licencia

Este proyecto usa licencia **MIT**: haz con él lo que quieras… pero con respeto.

---

### ✨ Resumen

PicoFrame es tu lienzo en blanco en PHP: limpio, elegante, con Twig integrado y un stack ligero.  
Un framework hecho para **no complicar lo simple** y abrir paso a un futuro donde la simplicidad manda.
