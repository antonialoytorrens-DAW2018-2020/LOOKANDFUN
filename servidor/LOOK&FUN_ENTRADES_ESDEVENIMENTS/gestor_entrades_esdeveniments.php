<html>

<head>
    <link rel="stylesheet" type="text/css" href="w3.css">
    <link rel="stylesheet" type="text/css" href="exercici1.php.css">
</head>

</html>
<?php
$con = new mysqli("127.0.0.1", "pma", "password", "LOOKANDFUN_ENTRADES_ESDEVENIMENTS");
$con->set_charset("utf8");

$tots = "SELECT PK_ID_ESDEVENIMENT, NOM, DESCRIPCIO, CONCAT(DATA_INICI, ' - ', DATA_FI) AS DURACIO, PREU, AFORAMENT, OCUPACIO, PK_NUMERO_ENTRADA, DESCOMPTE, DATA_ENTRADA, FK_CODI_PERSONA, ESDEVENIMENT.FK_CODI_RECINTE, FK_FILA_BUTACA, FK_NUMERO_BUTACA FROM ESDEVENIMENT INNER JOIN ENTRADA ON ESDEVENIMENT.PK_ID_ESDEVENIMENT = ENTRADA.PK_FK_ID_ENTRADA_ESDEVENIMENT";
$cursor_tots = $con->query($tots) or die("<h1>Error a l'hora de mostrar els ESDEVENIMENTS amb les ENTRADES</h1>");

// MOSTRA TAULA AMB TOTS ELS ESDEVENIMENTS

echo '<table id="titol">';
echo '<tr>';
echo '<th>';
echo 'ID_ESDEVENIMENT';
echo '</th>';
echo '<th>';
echo 'NOM';
echo '</th>';
echo '<th>';
echo 'DESCRIPCIO';
echo '</th>';
echo '<th>';
echo 'DURACIO';
echo '</th>';
echo '<th>';
echo 'PREU';
echo '</th>';
/*echo '<th>';
echo 'AFORAMENT';
echo '</th>';
echo '<th>';
echo 'OCUPACIO';
echo '</th>';*/
echo '<th>';
echo 'NUMERO_ENTRADA';
echo '</th>';
echo '<th>';
echo 'DESCOMPTE';
echo '</th>';
echo '<th>';
echo 'DATA_ENTRADA';
echo '</th>';
echo '<th>';
echo 'CODI_PERSONA';
echo '</th>';
echo '<th>';
echo 'CODI_RECINTE';
echo '</th>';
echo '<th>';
echo 'FILA_BUTACA';
echo '</th>';
echo '<th>';
echo 'NUMERO_BUTACA';
echo '</th>';
echo '</tr>';
while ($fila = $cursor_tots->fetch_assoc()) {
    echo '<tr>';
    echo '<td>';
    echo "<p>" . $fila["PK_ID_ESDEVENIMENT"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["NOM"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["DESCRIPCIO"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["DURACIO"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["PREU"] . "</p>";
    echo '</td>';
    /*echo '<td>';
    echo "<p>" . $fila["AFORAMENT"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["OCUPACIO"] . "</p>";
    echo '</td>';*/
    echo '<td>';
    echo "<p>" . $fila["PK_NUMERO_ENTRADA"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["DESCOMPTE"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["DATA_ENTRADA"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["FK_CODI_PERSONA"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["FK_CODI_RECINTE"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["FK_FILA_BUTACA"] . "</p>";
    echo '</td>';
    echo '<td>';
    echo "<p>" . $fila["FK_NUMERO_BUTACA"] . "</p>";
    echo '</td>';
    echo '</tr>';
}
echo "</table>";
?>