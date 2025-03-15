<?php
    $conn = new mysqli(hostname: "localhost", username: "root", password: "", database: "galeria");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>Galeria</title>
</head>
<body>
    <header id="baner">
        <h1>Zdjęcia</h1>
    </header>

    <div id="lewy">
        <h2>Tematy zdjęć</h2>

        <ol>
            <li>Zwierzęta</li>
            <li>Krajobrazy</li>
            <li>Miasta</li>
            <li>Przyroda</li>
            <li>Samochody</li>
        </ol>
    </div>

    <div id="srodkowy">
        <?php
            $sql = "SELECT z.plik, z.tytul, z.polubienia, a.imie, a.nazwisko FROM zdjecia z INNER JOIN autorzy a ON z.autorzy_id = a.id ORDER BY a.nazwisko ASC;";
            
            $result = $conn -> query(query: $sql);

            while($row = $result -> fetch_array()) {
                echo '<div class="zdjecia">';
                    echo '<img src=' . $row[0] . ' alt="zdjęcie">';
                    echo '<h3>' . $row[1] . '</h3>';
                    if($row[2] > 40) {
                        echo '<p>Autor: ' . $row[3] . ' ' . $row[4] . '.<br>Wiele osób polubiło ten obraz</p>';
                    } else {
                        echo '<p>Autor: ' . $row[3] . ' ' . $row[4] . '</p>';
                    }
                    echo '<a href="' . $row[0] . '" download="' . $row[0] . '">Pobierz</a>';
                echo '</div>';
            }
        ?>
    </div>

    <div id="prawy">
        <h2>Najbardziej lubiane</h2>
        <?php
            $sql = "SELECT tytul, plik FROM zdjecia WHERE polubienia >= 100;";

            $result = $conn -> query(query: $sql);

            while($row = $result -> fetch_array()) {
                echo '<img src="' . $row[1] . '" alt="' . $row[0] . '">';
            }
        ?>
        <strong>Zobacz wszystkie nasze zdjęcia</strong>
    </div>

    <footer id="stopka">
        <h5>Stronę wykonał: <a href="https://github.com/ferl19" target="_blank" style="position: static; opacity: 1">ferl19</a></h5>
    </footer>
</body>
</html>

<?php
    $conn -> close();
?>