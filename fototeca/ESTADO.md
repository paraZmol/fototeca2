## Hitos Completados
- [x] Crear layout y paleta de colores inmersiva.
- [x] Crear vista de galeria (index.blade.php) con diseño Grid.
- [x] Implementar logica de filtros en interfaz (top bar y sidebar).
- [x] Implementar refactorizacion 3 niveles (Province -> Category -> Subcategory) con Alpine.js y titulo dinamico.
- [x] Correccion sidebar: Provincias y Categorias con hijos usan acordeones Alpine.js (no enlaces directos).
- [x] Layout exclusivo `layouts/gallery.blade.php` con tema de biblioteca (madera/sepia oscuro).
- [x] Vista `gallery/index.blade.php` totalmente nueva con sidebar real de acordeones.
- [x] Integrar filtro y buscador de galería y ajustar visualización móvil.
- [x] Implementar sección pública de Fotografos (index y show) siguiendo el estilo visual de la biblioteca (Grid, overlay, datos).
- [x] Creación de página 'Sobre Nosotros' y reorganización de menú global (Inicio, Galería, Fotógrafos, Sobre Nosotros).
- [x] Añadir botones de acciones flotantes globales (WhatsApp y Yape con popup QR de aporte).
- [x] Implementar búsqueda en tiempo real (AJAX) en la galería sin recargar página.
- [x] Implementar Lightbox avanzado: doble columna (imagen/datos), navegación de arreglos (flechas izq/der) y zoom/pan libre estructurado.

## Fase Actual: 5 - Panel Administrable Custom
- [ ] Construir panel para subir fotos, asignar ubicaciones, categorias, fotografo, etc.
- [ ] Proteger rutas del panel tras middleware de roles (admin).
- [ ] Administrar crud de fotógrafos (opcional, si se requiere para editar bio y fechas).

## Notas de Contexto
* Se ha agregado un `PhotographerController` con vistas de galería para index/show de fotógrafos. Los seeders incluyen imágenes de perfil falsas (picsum).
* Se han modificado los seeders de Location para cumplir la regla solicitada: en lugar de anidar distritos con el mismo nombre que la provincia (ej. Carhuaz > Carhuaz), ahora llevan de frente etiquetas representativas (Puentes, Plaza, Catedral, Parques, Calles).
* Prioridad siguiente: Panel administrable custom para subir y gestionar fotos.
* La ruta /galeria apunta a GalleryController@index -> vista gallery/index.blade.php (layout gallery).
* La antigua index.blade.php (layouts/app) queda como legacy por si acaso, no se usa.

## Evaluación de Base de Datos (Normalización)
- Estado actual: Diseño altamente normalizado (3NF).
- Jerarquías: Usa "Adjacency List" (`parent_id`) en `locations` y `categories` para profundidad infinita. Eficiente.
- Relaciones: Tablas pivote N:M (`photo_category`, `photo_photographer` con `role`). Flexibilidad superior a relaciones 1:N rígidas.
- Veredicto: Estructura óptima y escalable. No necesita normalización adicional.
