<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Alta Llibre</title>
    <style>
        .error {
            color: red;
        }
        table {
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>

<?php
$modules = [1 => 'Modulo 1', 2 => "Modulo 2", 3 => "Modulo 3"];
$statusOpt = ["nuevo" => "Nuevo", "usado" => "Usado"];
$errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $modul = $_POST['module'];
            $publisher = trim($_POST['publisher']);
            $price = trim($_POST['price']);
            $pages = trim($_POST['pages']);
            $status = $_POST['status'];
            $comments = trim($_POST['comments']);

        }

        if (empty($publisher)) {
            $errors['publisher'] = "L'editorial és obligatòria.";
        }
        if (empty($price) || !is_numeric($price)) {
            $errors['price'] = "El preu ha de ser un número vàlid.";
        }
        if (empty($pages) || !is_numeric($pages)) {
            $errors['pages'] = "Les pàgines han de ser un número.";
        }
        if (empty($status)) {
            $errors['status'] = "L'estat és obligatori.";
        }

        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
            $nom_fitxer = $_FILES["photo"]["name"];
            //$tipus_fitxer = $_FILES["photo"]["type"];
            //$mida_fitxer = $_FILES["photo"]["size"];
            $ubicacio_temporal = $_FILES["photo"]["tmp_name"];

            $ubicacio_destinacio = "uploads/" . basename($nom_fitxer);
            if (move_uploaded_file($ubicacio_temporal, $ubicacio_destinacio)) {
                //echo "<p>El fitxer <strong>$nom_fitxer</strong> ha estat pujat correctament.</p>";
                //echo "<p>Tipus de fitxer: $tipus_fitxer</p>";
                //echo "<p>Mida del fitxer: " . ($mida_fitxer / 1024) . " KB</p>";
                //echo "<p>Ubicació del fitxer: $ubicacio_destinacio</p>";
            } else {
                echo "<p>Error al moure el fitxer a la ubicació final.</p>";
            }
        } else {
            echo "<p>Error al pujar el fitxer.</p>";
        }
        
        if (empty($errors)) {
            echo "<table>";
            echo "<tr><th>Mòdul</th><td>{$modules[$modul]}</td></tr>";
            echo "<tr><th>Editorial</th><td>" . htmlspecialchars($publisher) . "</td></tr>";
            echo "<tr><th>Preu</th><td>" . htmlspecialchars($price) . " €</td></tr>";
            echo "<tr><th>Pàgines</th><td>" . htmlspecialchars($pages) . "</td></tr>";
            echo "<tr><th>Estat</th><td>{$statusOpt[$status]}</td></tr>";
            echo "<tr><th>Comentaris</th><td>" . htmlspecialchars($comments) . "</td></tr>";
            echo "<tr><th>Foto</th><td><img src='$ubicacio_destinacio' alt='Imatge' width='500'></td></tr>";
            echo "</table>";
        }
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="module">Mòdul:</label>
        <select id="module" name="module">
            <?php
                foreach ($modules as $modul => $value) {
                    echo "<option value=\"$modul\" " . (isset($_POST['module']) && $_POST['module'] == $modul ? "selected" : "") . ">$value</option>";
                }
            ?>
        </select>
        <span class="error"><?php echo isset($errors['module']) ? $errors['module'] : ''; ?></span>
    </div>
    <div>
        <label for="publisher">Editorial:</label>
        <input type="text" id="publisher" name="publisher" value="">
        <span class="error"><!-- Missatge d'error per a l'editorial aquí --></span>
    </div>
    <div>
        <label for="price">Preu:</label>
        <input type="text" id="price" name="price" value="">
        <span class="error"><!-- Missatge d'error per al preu aquí --></span>
    </div>
    <div>
        <label for="pages">Pàgines:</label>
        <input type="text" id="pages" name="pages" value="">
        <span class="error"><!-- Missatge d'error per a les pàgines aquí --></span>
    </div>
    <div>
        <label for="status">Estat:</label>
        <?php
        foreach ($statusOpt as $stat => $value) {
            echo "<input type=\"radio\" id=\"$stat\" name=\"status\" value=\"$stat\" " . (isset($_POST['status']) && $_POST['status'] == $stat ? "checked" : "") . ">";
            echo "<label for=\"$stat\">$value</label>";
        }
        ?>
         <span class="error"><!-- Missatge d'error per a l'estat aquí --></span>
    </div>
    <div>
        <label for="photo">Foto:</label>
        <input type="file" id="photo" name="photo">
    </div>
    <div>
        <label for="comments">Comentaris:</label>
        <textarea id="comments" name="comments"></textarea>
    </div>
    <div>
        <button type="submit">Donar d'alta</button>
    </div>
</form>
<?php


?>

</body>
</html>

