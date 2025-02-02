# Gestión de Hábitos Saludables

## Descripción del Proyecto
Esta aplicación web se desarrollará utilizando la arquitectura MVC y acceso a datos con PDO. La plataforma permitirá a los usuarios registrar y hacer un seguimiento de sus hábitos saludables relacionados con el deporte y la alimentación. Contará con un sistema de gestión de usuarios con diferentes niveles de usuario (invitado, general, administrador) y una estructura de seguridad basada en sesiones y cookies. Se almacenarán imágenes en la base de datos, de las comidas o progresos realizados. 

## Tecnologías utilizadas
- PHP (PDO para acceso a datos)
- MySQL (Base de datos)
- HTML, CSS, BOOSTSTRAP
- GitHub (Control de versiones)

## Instalación y Uso
1. Descargar el proyecto: Puedes clonar el repositorio `git clone https://github.com/romeroestela/evaluble-final-MVC.git` o descargar la carpeta comprimida.
2. Configurar la base de datos: importa el archivo ` habitos_saludables.sql` en tu base de datos para crear las tablas necesarias.
3. Ajustar la configuración de la base de datos: Abre el archivo `app\libs\config.php` y agrega tus detalles de conexión (como el nombre de la base de datos, usuario, puerto y contraseña).
4. Iniciar el servidor y acceder: Ejecuta el servidor local en tu máquina y abre la aplicación en tu navegador para empezar a usarla.


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

# Explicación del Controller.php

El archivo `Controller.php` es el encargado de gestionar las peticiones del usuario y coordinar la lógica de la aplicación. Se encarga de procesar formularios, interactuar con la base de datos a través del modelo (`GestionHabitos.php`) y cargar las vistas adecuadas para mostrar la información al usuario.

## Estructura del Controller

El `Controller.php` sigue una estructura organizada con funciones específicas para cada acción que puede realizar un usuario en la aplicación. A continuación, se detallan sus principales componentes:

### 1. **Cargar Menú Según Nivel de Usuario**

El sistema maneja diferentes tipos de usuarios con distintos niveles de acceso:
- **Nivel 0 (Invitado):** Usuario no registrado.
- **Nivel 1 (Usuario):** Usuario registrado que puede gestionar sus hábitos.
- **Nivel 2 (Administrador):** Usuario con privilegios para gestionar datos generales de la aplicación.

La función `cargaMenu()` determina cuál menú debe mostrarse en función del nivel del usuario.

### 2. **Página de Inicio y Redirecciones**

- `home()`: Muestra la página de inicio para usuarios no registrados.
- `inicio()`: Muestra la página principal para usuarios registrados.
- `salir()`: Cierra la sesión del usuario y lo redirige a la página principal.
- `error()`: Muestra una página de error en caso de que ocurra un problema.

### 3. **Gestor de Autenticación**

- `iniciarSesion()`: Permite a los usuarios acceder a su cuenta verificando su nombre de usuario y contraseña. Si las credenciales son correctas, se inicia la sesión y se almacena su información.
- `registro()`: Permite registrar un nuevo usuario, validando sus datos y almacenándolos en la base de datos. Además, se permite subir una imagen de perfil.

### 4. **Gestor de Comidas y Actividades**

- `insertarComida()`: Permite a los usuarios registrar una comida, incluyendo su nombre, calorías, fecha y una imagen opcional.
- `verComidas()`: Muestra todas las comidas registradas por el usuario actual.
- `insertarActividad()`: Permite a los usuarios registrar una actividad, especificando su tipo, duración, calorías quemadas y fecha.
- `verActividades()`: Muestra todas las actividades registradas por el usuario actual.
- `buscarPorFecha()`: Permite buscar comidas y actividades registradas en una fecha específica.

### 5. **Funciones Exclusivas para Administradores**

- `verTodasComidas()`: Permite al administrador visualizar todas las comidas registradas por los usuarios.
- `verTodasActividades()`: Permite al administrador visualizar todas las actividades registradas por los usuarios.
- `verRecetas()`: Muestra todas las recetas disponibles.
- `insertarReceta()`: Permite al administrador agregar recetas a la base de datos.

## Flujo General de Funcionamiento

1. El usuario accede a la aplicación.
2. Si no está registrado, puede ver el menú de invitado y registrarse.
3. Si está registrado, inicia sesión y se le redirige según su nivel de usuario.
4. Un usuario puede registrar comidas y actividades, consultarlas y buscarlas por fecha.
5. Un administrador tiene acceso a funciones adicionales, como la gestión de recetas, podrá subir recetas que se podrán ver desde cualquier nivel de ususario y puede supervisar y borrar las comidas y actividades de los ususarios.



## **Modelo**

- **Gestiona la conexión con la base de datos** utilizando PDO, asegurando una conexión segura y estable.  
- **Realiza operaciones CRUD (Crear, Leer, Actualizar, Eliminar)** sobre las tablas de usuarios, comidas, actividades y recetas.  
- **Gestiona la inserción y recuperación de datos** relacionados con las comidas y actividades de los usuarios.  
- **Permite la gestión de recetas** para que los administradores puedan añadir contenido visible para todos los usuarios.  
- **Almacena y maneja imágenes** como fotos de perfil de usuario y fotos de comidas y recetas.

# Explicación del Modelo

## Estructura del Modelo
El archivo `classModelo.php` establece la conexión con la base de datos utilizando PDO y gestiona la lógica de acceso a los datos.
El archivo `classGestionHabitos.php` incluye varias funciones que permiten gestionar las tablas y relaciones dentro de la base de datos. También se encarga de validar datos antes de realizar las operaciones y de manejar los errores que puedan surgir durante la conexión con la base de datos.

### 1. **Conexión a la Base de Datos**

- `__construct()`: El constructor de la clase `Modelo` establece una conexión con la base de datos utilizando los parámetros definidos en el archivo de configuración (`config.php`). La conexión se hace a través de PDO, y se asegura de que la comunicación con la base de datos sea en UTF-8.

### 2. **Gestión de Usuarios**

- `insertarUsuario($nombre, $apellido, $nombreUsuario, $contrasenya, $foto_perfil = null)`: Permite registrar un nuevo usuario en la base de datos. Si el usuario no proporciona una foto de perfil, se asigna una imagen por defecto.
- `consultarUsuario($nombreUsuario)`: Obtiene los detalles de un usuario en función del nombre de usuario. Utiliza una consulta preparada para evitar inyecciones SQL.
  
### 3. **Gestión de Comidas**

- `insertarComida($idUser, $nombre, $calorias, $foto, $fecha)`: Permite a un usuario registrar una comida, indicando su nombre, calorías, foto y fecha. Si no se proporciona una foto, se asigna una imagen por defecto.
- `obtenerComidas($idUser)`: Recupera todas las comidas asociadas a un usuario específico.
- `obtenerComidasPorFecha($idUser, $fecha)`: Recupera las comidas de un usuario en una fecha específica.

### 4. **Gestión de Actividades**

- `insertarActividad($idUser, $tipo, $duracion, $calorias, $fecha)`: Registra una actividad realizada por un usuario, incluyendo su tipo, duración, calorías y fecha.
- `obtenerActividades($idUser)`: Obtiene todas las actividades realizadas por un usuario específico.
- `obtenerActividadesPorFecha($idUser, $fecha)`: Recupera las actividades de un usuario en una fecha específica.

### 5. **Funciones para Administradores**

- `obtenerTodasComidas()`: Permite al administrador ver todas las comidas registradas por todos los usuarios.
- `obtenerTodasActividades()`: Permite al administrador ver todas las actividades registradas por todos los usuarios.
- `insertarReceta($titulo, $ingredientes, $instrucciones, $imagenes_recetas)`: Permite a un administrador agregar nuevas recetas en la base de datos. Esto incluye el título, los ingredientes, las instrucciones y las imágenes asociadas a la receta

### 6. **Funciones para todos los ususarios**
- `obtenerRecetas()`: Permite a todos los usuarios obtener todas las recetas almacenadas en la base de datos.



## **Vista de Rutas y Control de Acceso (index.php)**

- **Gestiona las rutas de la aplicación**, redirigiendo al usuario a la acción adecuada del controlador según la URL solicitada.  
- **Valida los niveles de usuario**, asegurando que solo los usuarios con permisos adecuados puedan acceder a ciertas rutas.  
- **Muestra errores 404** si la ruta solicitada no existe o el usuario no tiene los permisos necesarios.  
- **Define una ruta predeterminada**, redirigiendo al usuario a la página de inicio si no se especifica ninguna ruta en la URL.  

# Explicación del index.php

El archivo `index.php` actúa como el punto de entrada principal para la navegación de la aplicación. Su función es interpretar las rutas solicitadas por los usuarios, validar los permisos según el nivel de usuario y ejecutar la acción correspondiente dentro del controlador adecuado.

## Estructura del index.php

El `index.php` tiene una estructura simple que asegura que las acciones se ejecuten correctamente según las rutas y permisos del usuario.

### 1. **Gestión de las Rutas**

El archivo usa un `map` que conecta las rutas de la URL con las acciones que deben hacer los controladores. 

### 2. **Verificación del Nivel de Usuario**

Antes de hacer cualquier acción, `index.php` revisa el nivel de acceso del usuario (guardado en su sesión) y lo compara con el nivel necesario para la ruta que está pidiendo. Si tiene el nivel adecuado, se ejecuta la acción. Si no, el usuario es redirigido a una página que sí puede ver, como la página de inicio.

### 3. **Manejo de Errores**

Si el usuario intenta acceder a una ruta que no existe o no tiene permisos para hacerlo, el sistema muestra un error 404. Esto evita que el usuario vea cosas que no debería o que no están disponibles para él.

### 4. **Ruta Predeterminada**

Si la URL no tiene una ruta definida, el sistema automáticamente lleva al usuario a la página de inicio, asegurándose de que siempre haya algo visible para él.


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
    - [x] Procesar datos del formulario de registro y guardar en BD.
    - [x] Procesar datos del formulario de inicio de sesión (validar credenciales).

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
    - [x] Una vez logueado el usuario, mostrará el nombre y la imagen de perfil en el resto de páginas.
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

### Estilizado
1. Aplicar CSS básico para el diseño.
    - [x] Crear hojas de estilo.

### Pruebas
1. Probar la aplicación con diferentes tipos de usuarios.
    - [x] Crear cuentas de prueba.
2. Revisar errores y corregirlos.
    - [x] Corregir errores y mejorar del código.


## Extras
- Incluir breve descripción explicando que hace la aplicación. 
- El código incluye comentarios para facilitar su comprensión.
- Realizar una README explicando que hace la aplicación, como funciona el patrón MVC en mi aplicación.


## Estela Romero Ferri


