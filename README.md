# Gestión de Hábitos Saludables

## Descripción del Proyecto
Esta aplicación web se desarrollará utilizando la arquitectura MVC y acceso a datos con PDO. La plataforma permitirá a los usuarios registrar y hacer un seguimiento de sus hábitos saludables relacionados con el deporte y la alimentación. Contará con un sistema de gestión de usuarios con diferentes roles (invitado, general, administrador) y una estructura de seguridad basada en sesiones y cookies. Se almacenarán imágenes en la base de datos, de las comidas o progresos realizados. 

## Tecnologías utilizadas
- PHP (PDO para acceso a datos)
- MySQL (Base de datos)
- HTML, CSS
- GitHub (Control de versiones)

## Lista de Tareas

### Configuración Inicial
1. Crear un repositorio en GitHub y añadir a la profesora.
    - [ ] Crear repositorio.
    - [ ] Añadir usuario de la profesora.
2. Crear la estructura base del proyecto.
    - [ ] Crear carpetas: `app`, `controlador`, `libs`, `log`, `modelo`, `web`, `css`, `templates`,.
    - [ ] Configurar archivo `.gitignore`.

### Base de Datos
1. Diseñar la estructura de la base de datos con al menos 3 tablas relacionadas.
    - [ ] Tabla `usuarios` (id, nombre, email, contraseña, rol, foto_perfil).
    - [ ] Tabla `actividades` (id, usuario_id, tipo, duración, calorías, fecha).
    - [ ] Tabla `comidas` (id, usuario_id, nombre, calorías, foto, fecha).
2. Crear la base de datos y tablas en MySQL.
    - [ ] Implementar script SQL para la creación.
3. Configurar la conexión PDO.
    - [ ] Crear archivo de configuración con credenciales.

### Desarrollo del Modelo (M de MVC)
1. Crear clases de modelo para la gestión de datos.
    - [ ] Definir atributos y métodos CRUD. 
2. Implementar métodos CRUD para cada entidad.
    - [ ] Crear métodos `create`, `read`, `update`, `delete` para cada tabla.

### Desarrollo del Controlador (C de MVC)
1. Crear controladores para manejar la lógica.
    - [ ] Definir funciones para gestionar usuarios.
    - [ ] Definir funciones para registrar actividades deportivas.
    - [ ] Definir funciones para registrar comidas saludables.
2. Implementar funcionalidad de registro e inicio de sesión.
    - [ ] Crear formulario de registro.
    - [ ] Procesar datos y guardar en BD.

### Desarrollo de las Vistas (V de MVC)
1. Diseñar plantillas HTML para la zona pública.
    - [ ] Crear páginas de bienvenida y navegación.
2. Diseñar plantillas HTML para la zona privada.
    - [ ] Crear dashboard de usuario con resumen de actividades y comidas.
    - [ ] Mostrar nombre e imagen de perfil del usuario logueado.

### Seguridad
1. Implementar validación de formularios en el lado del servidor.
    - [ ] Validar datos de entrada.
2. Implementar protección contra SQL Injection.
    - [ ] Utilizar consultas preparadas.
3. Implementar sistema de sesiones y cookies.
    - [ ] Crear sistema de inicio/cierre de sesión seguro.

### Funcionalidades Adicionales
1. Subida y gestión de imágenes.
    - [ ] Implementar carga de fotos para perfil y comidas.
2. Implementar mensajes de feedback para los usuarios.
    - [ ] Mostrar mensajes de error.

### Estilizado y Presentación
1. Aplicar CSS básico para el diseño.
    - [ ] Crear hojas de estilo.
2. Preparar la presentación para Teams o presencial.
    - [ ] Organizar flujo de presentación.

### Pruebas
1. Probar la aplicación con diferentes tipos de usuarios.
    - [ ] Crear cuentas de prueba.
2. Revisar errores y corregirlos.
    - [ ] Corregir errores y mejorar del código.

## Instalación y Uso
1. Clonar el repositorio: `git clone <URL_DEL_REPOSITORIO>`
2. Configurar la base de datos importando el archivo `database.sql`
3. Configurar las credenciales de conexión en `config/database.php`
4. Ejecutar el servidor local y acceder a la aplicación

## Extras
- Incluir breve descripción explicando que hace la aplicación. 
- El código incluye comentarios para facilitar su comprensión.
- La documentación del proyecto está incluida en la carpeta `docs`.

## Estela Romero Ferri


