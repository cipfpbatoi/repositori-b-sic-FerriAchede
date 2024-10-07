<?php
session_start();
require 'functions.php';
 
$valid_user = "ferran";
$valid_password = "1234";

// Cerrar sesión
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
}

// Inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['logout'])) {
    $user = cleanInput($_POST['username']);
    $password = cleanInput(($_POST['password']));

    if ($user === $valid_user && $password === $valid_password) {
        $_SESSION['username'] = $user;

        echo "Bienvenido $user <br>";
        echo "<a href='./ejer1.php'>Exercici 1: Sistema de Carret de Compres sense Base de Dades</a>";
    } else{
        $error_message = "Usuario o contraseña incorrectos.";
    }
}
?>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>

<body>
    <?php if (!isset($_SESSION['username'])): ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error_message)): ?>
            <p style="color:red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Nombre de usuario" required> <br>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <?php endif; ?>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>

</html>