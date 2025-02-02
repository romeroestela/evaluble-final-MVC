<!DOCTYPE html>
<html lang="es">

<head>
<title>Gestión de Habitos</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- Encabezado -->
    <div class="container-fluid bg-success text-white text-center py-3">
        <h1>Gestión de Hábitos Saludables</h1>
        <p>Registra tus actividades y comidas diarias para llevar un estilo de vida más saludable</p>
    </div>

    <?php	
	if (isset($menu) && $menu !== null) {
        include $menu;
    }
    
    ?>

    <!-- Contenido dinámico -->
    <div class="container my-4">
        <div id="contenido">
            <?php echo $contenido ?>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="container-fluid bg-secondary text-white text-center py-3 mt-5">
        <h5>Cuida tu bienestar, sigue tus hábitos saludables</h5>
    </footer>

</body>

</html>
