<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilo.css">
  <style>
    .error {
            color: red;
            font-size: 0.9em;
            margin-left: 10px;
        }
</style>
</head>

<body>


<h2>Formulari de Registre</h2>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $mail = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $errors = [];

        if (empty($name)) {
            $errors['name'] = "Rellene el campo";
        }
        if (empty($mail)) {
            $errors['email'] = "Rellene el campo";
        }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Introduce un correo electronico valido.";
        }

        $passwordRegex = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,}$/";
        if (empty($password)) {
            $errors['password'] = "Rellene el campo";
        }elseif (!preg_match($passwordRegex, $password)) {
            $errors['password'] = "La contraseña tiene que contener 8 caràcters, una mayuscula, una minúscula, un número y un caracter especial.";
        }

        if (empty($confirmPassword)) {
            $errors['confirmPassword'] = "Rellene el campo";
        }elseif ($password !== $confirmPassword) {
            $errors['confirmPassword'] = "Las contraseñas no coinciden.";
        }
        
        if (empty($errors)) {
            $successMessage = "Registro completado con exito!";
        }
    }
?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <li>
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required>
            <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
        </li>
        <li>
            <label for="email">Correo electronico:</label>
            <input type="email" id="email" name="email" required>
            <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
        </li>
        <li>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
        </li>
        <li>
            <label for="confirmPassword">Confirmar contraseña:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <span class="error"><?php echo isset($errors['confirmPassword']) ? $errors['confirmPassword'] : ''; ?></span>
        </li>
        <input type="submit" value="enviar">
        <br><?php echo isset($successMessage) ? $successMessage : ''; ?>
    </form>
<?php
    
?>

</body>

</html>




