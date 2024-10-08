<?php
session_start();

function cleanInput($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
}

$valid_email = "asd@asd.es";
$valid_password_hash = password_hash("1234", PASSWORD_DEFAULT);

// Logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    if (isset($_COOKIE['username'])) {
        setcookie("username", "", time() - 3600, "/");
    }
    header("Location: index.php");
    exit();
}

if (isset($_COOKIE['username']) && !isset($_SESSION['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['logout'])) {
    $email = cleanInput($_POST["email"]);
    $username = cleanInput($_POST["username"]);
    $password = cleanInput($_POST["password"]);
    $remember = isset($_POST["remember"]);

    if ($email === $valid_email && password_verify($password, $valid_password_hash)) {
        $_SESSION['user'] = $username;

        // Al seleccionar "Recordarme" crea una cookie de 30 min
        if ($remember) {
            setcookie("username", $username, time() + (1800), "/");
        }
    } else {
        $error_message = "Nombre de usuario o contraseña incorrectos.";
    }
}

if (isset($_SESSION['user'])) {
    echo "Usuario: " . htmlspecialchars($_SESSION['user']) . "<br>";
    echo "Juegos: <br>";
    echo "<a href='./lofegat/ofegat.php'>L'Ofegat</a> <br>";
    echo "<a href='./4ratlla/4ratlla.php'>4 en ratlla</a>";
}

?>


<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>

<body>
    <?php if (!isset($_SESSION['user'])): ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Iniciar Sesión</h2>
            <?php if (isset($error_message)): ?>
                <p style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <input type="email" name="email" placeholder="Correo electronico" required>
            <input type="text" name="username" placeholder="Nombre de usuario" required> <br>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <label>
                <input type="checkbox" name="remember" <?php if (isset($_COOKIE['username'])) echo 'checked'; ?>> Recordarme
            </label>
        </form>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>

</html>