<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['elimina_producte'])) {
    $producte = $_POST['elimina_producte'];

    if (isset($_SESSION['carrito'][$producte])) {
        // Si queda uno lo elmina
        if ($_SESSION['carrito'][$producte] > 1) {
            $_SESSION['carrito'][$producte]--;
        } else {
            unset($_SESSION['carrito'][$producte]);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Carret de compra</title>
</head>
<body>
    <h1>Carrito</h1>
    <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
        <table>
            <tr>
                <th>Producte</th>
                <th>Quantitat</th>
                <th>Acció</th>
            </tr>
            <?php foreach ($_SESSION['carrito'] as $producte => $quantitat): ?>
            <tr>
                <td><?php echo htmlspecialchars($producte); ?></td>
                <td><?php echo $quantitat; ?></td>
                <td>
                    <form action="carret.php" method="POST">
                        <button type="submit" name="elimina_producte" value="<?php echo htmlspecialchars($producte); ?>">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>El carrito está vacio.</p>
    <?php endif; ?>
    
    <a href="ejer1.php">Volver a los productos</a>
</body>
</html>