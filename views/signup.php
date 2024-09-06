<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    </head>

<?php require 'header-signup.php'; ?>

<body>
    <div class="container">
        <h2>Crear su cuenta</h2>
        <form action="../controllers/UserController.php" method="post" class="form-signup">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" placeholder="Nombre" required class="input-field">
            </div>
            <div class="form-group">
                <label for="surname">Apellido</label>
                <input type="text" name="surname" id="surname" placeholder="Apellido" required class="input-field">
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" placeholder="Correo electrónico" required class="input-field">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Contraseña" required class="input-field">
            </div>

            <button type="submit" class="btn-submit">Crear cuenta</button>
        </form>
    </div>
</body>

</html>
