<!DOCTYPE html>
<?php session_start()?>
<?php 
    include 'connect.php';
    $query = "SELECT * FROM Clanak WHERE kategorija='MUSICA'";
    $result = mysqli_query($dbc, $query);
?>
<html lang='hr'>
    <head>
        <title> Musica </title>
        <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name='description' content='Projekt pwa'>
        <meta name='keywords' content='programiranje, php, web, tvz'>
        <meta name='author' content='Vito Vdović'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="stil.css" type="text/css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img height="50" src="https://www.sopitas.com/wp-content/uploads/2022/04/logo-sopitas-3.png" class="custom-logo jetpack-lazy-image jetpack-lazy-image--handled" alt="Sopitas.com" decoding="async" data-attachment-id="1440329" data-permalink="https://www.sopitas.com/logo-sopitas-3/" data-orig-file="https://www.sopitas.com/wp-content/uploads/2022/04/logo-sopitas-3.png" data-orig-size="256,99" data-comments-opened="1" data-image-meta="{&quot;aperture&quot;:&quot;0&quot;,&quot;credit&quot;:&quot;&quot;,&quot;camera&quot;:&quot;&quot;,&quot;caption&quot;:&quot;&quot;,&quot;created_timestamp&quot;:&quot;0&quot;,&quot;copyright&quot;:&quot;&quot;,&quot;focal_length&quot;:&quot;0&quot;,&quot;iso&quot;:&quot;0&quot;,&quot;shutter_speed&quot;:&quot;0&quot;,&quot;title&quot;:&quot;&quot;,&quot;orientation&quot;:&quot;0&quot;}" data-image-title="logo-sopitas-3" data-image-description="" data-image-caption="" data-medium-file="https://www.sopitas.com/wp-content/uploads/2022/04/logo-sopitas-3.png" data-large-file="https://www.sopitas.com/wp-content/uploads/2022/04/logo-sopitas-3.png" data-lazy-loaded="1" loading="eager">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="musica.php">Musica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deportes.php">Deportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="administrator.php">Administracija</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="unos.php">Unos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registracija.php">Registracija</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php
                if (isset($_SESSION['korisnickoIme'])) {
                    echo '<li class="nav-item">'
                            . $_SESSION['korisnickoIme'] . 
                          '</li>';
                    echo '<li class="nav-item">
                            <a class="nav-link" href="odjava.php">Odjava(' . $_SESSION['korisnickoIme'] . ')</a>
                          </li>';
                } else {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="prijava.php">Prijava</a>
                          </li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
    <content>
    <br>
        <div class="container-fluid">
                <div class="row">
                    <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<div class="col-md-4">';
                            echo "<article class='article'>";
                            echo '<div class="musica_img">';
                            echo '<a href="clanak.php?id=' . $row['id'] . '">';
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['slika']) . '">';
                            echo '</a>';
                            echo "</div>";
                            echo '<div class="media_body">';
                            echo '<h4 class="title">';
                            echo '<a href="clanak.php?id=' . $row['id'] . '">';
                            echo $row['naslov'];
                            echo '</a></h4>';
                            echo '<p class="date">' . date("d.m.Y", strtotime($row['datum'])) . '</p>';
                            echo '</div>';
                            echo '</article>';
                            echo '</div>';
                        }

                        mysqli_close($dbc);
                    ?>
                </div>
        </div>
        <br>       
    </content>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; 2024 Sopitas.com |  Vito Vdović  |  vvdovic@tvz.hr</p>
        </div>
    </footer>
    </body>
</html>
