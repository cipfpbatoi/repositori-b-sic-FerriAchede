<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Si no hay carrito lo crea
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    $producte = $_POST['producte'];

    // Agregar el producto al carrito
    if (isset($_SESSION['carrito'][$producte])) {
        $_SESSION['carrito'][$producte]++;
    } else {
        $_SESSION['carrito'][$producte] = 1;
    }
    
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Selecció de productes</title>
</head>
<body>
    <h1>Afegir productes al carret</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="producte">Tria un producte:</label>
        <select name="producte" id="producte">
            <option value="Poma">Poma</option>
            <option value="Plàtan">Plàtan</option>
            <option value="Taronja">Taronja</option>
        </select>
        <input type="submit" value="Afegir al carret">
    </form>
    <a href="carret.php">Veure carret</a>
</body>
</html>
