# Gestión de Hábitos Saludables

## Descripción del Proyecto
Esta aplicación web se desarrollará utilizando la arquitectura MVC y acceso a datos con PDO. La plataforma permitirá a los usuarios registrar y hacer un seguimiento de sus hábitos saludables relacionados con el deporte y la alimentación. Contará con un sistema de gestión de usuarios con diferentes niveles de usuario (invitado, general, administrador) y una estructura de seguridad basada en sesiones y cookies. Se almacenarán imágenes en la base de datos, de las comidas o progresos realizados. 

## Tecnologías utilizadas
- PHP (PDO para acceso a datos)
- MySQL (Base de datos)
- HTML, CSS
- GitHub (Control de versiones)

## Instalación y Uso
1. Clonar el repositorio: `git clone https://github.com/romeroestela/evaluble-final-MVC.git`
2. Configurar la base de datos importando el archivo ` habitos_saludables.sql`
3. Configurar las credenciales de conexión en `config/habitos_saludables.php`
4. Ejecutar el servidor local y acceder a la aplicación

### Configuración del Administrador
Para poder acceder al usuario Administrador puedes hacerlo desde *Iniciar Sesión* y poner *Nombre de usuario = Admin*, *Contraseña= Admin*.

# **Estructura del Proyecto**  

Este proyecto sigue el patrón **MVC (Modelo - Vista - Controlador)** para organizar el código de manera clara y estructurada.  

## **Controlador (Controller.php)** 

-  **Carga el menú adecuado** según el nivel del usuario (invitado, usuario normal o administrador).  
-  **Maneja la autenticación**, permitiendo a los usuarios iniciar y cerrar sesión.  
-  **Registra nuevas cuentas** y almacena la foto de perfil.  
-  **Gestiona la inserción y visualización de datos**, como comidas y actividades registradas.  
-  **Administra recetas**, permitiendo a los administradores agregar contenido para todos los usuarios.  



## Lista de Tareas

### Configuración Inicial
1. Crear un repositorio en GitHub y añadir a la profesora.
    - [X] Crear repositorio.
    - [X] Añadir usuario de la profesora.
2. Crear la estructura base del proyecto.
    - [X] Configurar archivo `.gitignore`.

### Base de Datos
1. Diseñar la estructura de la base de datos con al menos 3 tablas relacionadas.
    - [X] Tabla `usuarios` (idUser, nombre, apellido, nombreUsuario, contraseña, nivel_usuario, foto_perfil).
    - [X] Tabla `actividades` (idActividad, idUser, tipo, duración, calorías, fecha).
    - [X] Tabla `comidas` (idComida, idUser, nombre, calorías, foto, fecha).
2. Crear la base de datos y tablas en MySQL.
    - [X] Implementar script SQL para la creación.
3. Configurar la conexión PDO.
    - [X] Crear archivo de configuración con credenciales.

### Desarrollo del Modelo (M de MVC)
1. Crear clases de modelo para la gestión de datos.
    - [X] Crear fichero `classModel.php`. La clase Modelo manejará la conexión a la base de datos y puede incluir métodos genéricos que sean útiles para cualquier entidad.

### Desarrollo del Controlador (C de MVC)
1. Crear controladores para manejar la lógica.
    - [X] Definir funciones para gestionar usuarios.
    - [x] Definir funciones para registrar actividades deportivas.
    - [x] Definir funciones para registrar comidas saludables.
2. Implementar funcionalidad de registro e inicio de sesión.
    - [ ] Procesar datos del formulario de registro y guardar en BD.
    - [ ] Procesar datos del formulario de inicio de sesión (validar credenciales).

### Desarrollo de las Vistas (V de MVC)
1. Templates base (estructuras comunes para varias páginas):
    - [x] layout.php (estructura principal). 
    - [x] menuInvitado.php, menuUsuario.php y menuAdmin.php (navegación según usuario).
2. Vistas públicas:
    - [x] inicio.php (página principal).
    - [x] registro.php (formulario de registro).
3. Vistas privadas:
    - [x] perfil.php (ver y editar información del usuario). 
    - [x] insertarComida.php (Formulario para insertar Comida).
    - [x] insertarActividad.php (Formulario para insertar Actividad).
    - [x] verActividades.php (lista de actividades del usuario).
    - [x] verComidas.php (lista de comidas del usuario).
    - [X] buscar_por_fecha.php (buscar actividades y comidas por fecha).
4. Plantillas especiales:
    - [X] error.php (pantalla de error).

### Seguridad
1. Implementar validación de formularios en el lado del servidor.
    - [x] Validar datos de entrada.
2. Implementar protección contra SQL Injection.
    - [x] Utilizar consultas preparadas.
3. Implementar sistema de sesiones y cookies.
    - [x] Crear sistema de inicio/cierre de sesión seguro.

### Funcionalidades Adicionales
1. Subida y gestión de imágenes.
    - [x] Implementar carga de fotos para perfil y comidas.
2. Implementar mensajes de feedback para los usuarios.
    - [x] Mostrar mensajes de error.
    - [x] Crear pantalla genérica de error.

### Estilizado y Presentación
1. Aplicar CSS básico para el diseño.
    - [ ] Crear hojas de estilo.
2. Preparar la presentación para Teams o presencial.
    - [ ] Organizar flujo de presentación.

### Pruebas
1. Probar la aplicación con diferentes tipos de usuarios.
    - [x] Crear cuentas de prueba.
2. Revisar errores y corregirlos.
    - [x] Corregir errores y mejorar del código.


## Extras
- Incluir breve descripción explicando que hace la aplicación. 
- El código incluye comentarios para facilitar su comprensión.




## Estela Romero Ferri


