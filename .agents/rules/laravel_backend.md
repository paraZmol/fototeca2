---
trigger: glob
globs: **/*.php
---

# Contexto y Restricciones
- Stack: Laravel 11 MVC puro con vistas Blade y MySQL.
- Prohibición absoluta: NO instalar ni utilizar FilamentPHP, Livewire, ni Inertia.js. Todo el admin es custom.
- Modelos: Siempre usar `$fillable`, tipado estricto y definir relaciones (belongsTo, hasMany).
- Migraciones: Usar restricciones de claves foráneas (`constrained()->cascadeOnDelete()`).
- Eficiencia de Tokens: Devuelve únicamente el código PHP, sin saludos, sin explicaciones teóricas y sin texto 
de relleno.
- Idioma: Esquema de DB en inglés (estándar), pero comentarios de código, descripciones y datos (seeds) siempre en español.
- Convención: DB y Código en Inglés. Vistas (Blade) y Validaciones en Español.
- Comentarios: Siempre en minúsculas, sin tildes, sin puntos finales y sin caracteres especiales (formato plano simplificado).
- Estructura DB (Inglés):
  - Category: id, name
  - Subcategory: id, name, category_id
  - [cite_start]Photographer: id, full_name, birth_place, birth_date, death_place, death_date, bio, studies_critique [cite: 38, 39, 40, 41, 42]
  - [cite_start]Photo: id, title, description, year, photographer_id, subcategory_id, provider, image_path [cite: 52, 53, 54, 56]
- Relaciones: Category (1:N) Subcategory (1:N) Photo. Photographer (1:N) Photo.
- Imagen: Tabla `photos` con `image_path` (local) e `image_url` (remoto), ambos nullable. Lógica debe asegurar que solo uno esté activo por registro.