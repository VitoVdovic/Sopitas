<!DOCTYPE html>
<?php session_start()?>
<html lang='hr'>
    <head>
        <title> Unesen članak </title>
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
                    <a class="nav-link" href="musica.php">Musica</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="deportes.php">Deportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="administrator.php">Administracija</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="unos.php">Unos</a>
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
        <div class="mb-3" id="naslov_forme1">
            <h1> Preview članka </h1>
            <h2> Ovako izgleda članak kojeg ste unijeli u bazu: </h2>
            <br>
        </div>
        <?php
            if (isset($_POST['naslovVijesti'])) {
                $naslovVijesti = $_POST['naslovVijesti'];
            }
            if (isset($_POST['kratkiSazetak'])) {
                $kratkiSazetak = $_POST['kratkiSazetak'];
            }
            if (isset($_POST['tekstVijesti'])) {
                $tekstVijesti = $_POST['tekstVijesti'];
            }
            if (isset($_POST['kategorijaVijesti'])) {
                $kategorijaVijesti = $_POST['kategorijaVijesti'];
            }
            if (isset($_POST['odabirSlike'])) {
                $slika = $_POST['odabirSlike'];
            }
            if (isset($_POST['prikazNaStranici'])) {
                $prikazNaStranici = $_POST['prikazNaStranici'];
            }
        ?>
        <section class="naslovV">
            <h1> <?php echo $naslovVijesti; ?> </h1>
        </section>
        <section class="kategorijaV">
            <p style="color: gray;"> <?php 
                $datum1 = date('d.m.Y. H:i');
                echo "$kategorijaVijesti  |  $datum1" 
            ?> </p>
        </section>
        <section class="kratkiV">
            <h2> <?php echo $kratkiSazetak; ?> </h2>
        </section>
        <?php
            include 'connect.php';

            if (isset($_POST['prikazNaStranici'])) {
                $arhiva = 0;
            } else {
                $arhiva = 1;
            }
            $datum = date('Y-m-d H:i:s');
            
            $image = $_FILES['odabirSlike']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
    
            $query = "INSERT INTO Clanak (datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
            VALUES ('$datum', '$naslovVijesti', '$kratkiSazetak', '$tekstVijesti', '$imgContent', '$kategorijaVijesti', '$arhiva')";
    
            $result = mysqli_query($dbc, $query) or die('Error querying database');
           
            mysqli_close($dbc);
        ?>
        <section class="slikaV">
        <?php
        include 'connect.php';
        $query = "SELECT slika FROM Clanak ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($dbc, $query);
        $i = 0;
        while ($row = mysqli_fetch_array($result)) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['slika']) . '" style="width: 80%; margin-top: 10px; margin-bottom: 10px;">';

        }
        ?>
        </section>
        <section class="tekstV">
            <p> <?php echo $tekstVijesti ?> </p>
        </section>
        <section class="prikazV" style="margin-bottom: 15px;">
            <?php
                if ($prikazNaStranici == "prihvaceno") {
                    echo "<p><b> Ovaj članak se prikazuje na stranici. </b></p>";
                } else {
                    echo "<p><b> Ovaj članak se ne prikazuje na stranici. </b></p>";
                }
            ?>
        </section>

    </content>
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; 2024 Sopitas.com |  Vito Vdović  |  vvdovic@tvz.hr</p>
        </div>
    </footer>

    </body>
</html>
