<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<?php require 'header.php'; ?>

<body>
    <div class="container">
        <h2>Iniciar sesión en <span class="highlight">web</span></h2>
        
        <form class="form-login" action="../controllers/AuthController.php" method="post">
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required class="input-field">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Contraseña" required class="input-field">
            </div>
            
            <button type="submit" class="btn-submit">INICIAR SESIÓN</button>
        </form>
    </div>
</body>

</html>
