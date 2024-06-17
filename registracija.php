<!DOCTYPE html>
<?php session_start(); ?>
<html lang='hr'>
<head>
    <title> Registracija </title>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='Projekt pwa'>
    <meta name='keywords' content='programiranje, php, web, tvz'>
    <meta name='author' content='Vito Vdović'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="stil.css" type="text/css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<style>
    article {
        width: 40%;
        margin: 0 auto;
    }
    #naslov_forme{
        width: 40%;
    }
    label {
        font-weight: bold;
    }
    a {
        text-decoration: underline;
    }
</style>
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
                    <a class="nav-link" href="unos.php">Unos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="registracija.php">Registracija</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php
                if (isset($_SESSION['korisnickoIme'])) {
                    echo '<li class="nav-item">'
                            . htmlspecialchars($_SESSION['korisnickoIme']) . 
                          '</li>';
                    echo '<li class="nav-item">
                            <a class="nav-link" href="odjava.php">Odjava(' . htmlspecialchars($_SESSION['korisnickoIme']) . ')</a>
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
<div class='mb-3' id='naslov_forme'>
    <h1> Registracija </h1>
    <h2> Unesite podatke za registraciju: </h2>
</div>
<article class='formaUnos'>
    <div class='container mt-5'>
        <?php
        $korisnickoImeErr = $imeErr = $prezimeErr = $lozinkaErr = "";
        $korisnickoIme = $ime = $prezime = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "Sopitas";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $korisnickoIme = test_input($_POST["korisnickoIme"]);
            $ime = test_input($_POST["ime"]);
            $prezime = test_input($_POST["prezime"]);
            $lozinka = test_input($_POST["lozinka1"]);

            if (empty($korisnickoIme)) {
                $korisnickoImeErr = "Korisničko ime je obavezno";
            } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $korisnickoIme)) {
                $korisnickoImeErr = "Dozvoljeni su samo slova i brojevi";
            }

            if (empty($ime)) {
                $imeErr = "Ime je obavezno";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $ime)) {
                $imeErr = "Dozvoljena su samo slova i razmaci";
            }

            if (empty($prezime)) {
                $prezimeErr = "Prezime je obavezno";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $prezime)) {
                $prezimeErr = "Dozvoljena su samo slova i razmaci";
            }

            if (empty($lozinka)) {
                $lozinkaErr = "Lozinka je obavezna";
            } elseif (strlen($lozinka) < 8) {
                $lozinkaErr = "Lozinka mora imati barem 8 znakova";
            }

            if (empty($korisnickoImeErr) && empty($imeErr) && empty($prezimeErr) && empty($lozinkaErr)) {
                // Priprema izjave s pripremljenom izjavom
                $sql = "INSERT INTO korisnik (korisnickoIme, ime, prezime, lozinka, razina) VALUES (?, ?, ?, ?, 0)";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    echo "Error preparing statement: " . $conn->error;
                } else {
                    // Povezivanje parametara i izvršavanje izjave
                    $stmt->bind_param("ssss", $korisnickoIme, $ime, $prezime, $hashed_password);
                    $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT);
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success' role='alert'>Uspješno ste registrirani.</div>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
                }
            }

            $conn->close();
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <form id='registracijaForma' name='registracijaForma' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
            <div class='mb-3'>
                <label for='korisnickoIme' class='form-label'>Korisničko ime:</label>
                <input type='text' class='form-control <?php if(!empty($korisnickoImeErr)) echo 'is-invalid'; ?>' id='korisnickoIme' name='korisnickoIme' value='<?php echo htmlspecialchars($korisnickoIme); ?>' required>
                <div class='invalid-feedback'><?php echo $korisnickoImeErr;?></div>
            </div>
            <div class='mb-3'>
                <label for='ime' class='form-label'>Ime:</label>
                <input type='text' class='form-control <?php if(!empty($imeErr)) echo 'is-invalid'; ?>' id='ime' name='ime' value='<?php echo htmlspecialchars($ime); ?>' required>
                <div class='invalid-feedback'><?php echo $imeErr;?></div>
            </div>
            <div class='mb-3'>
                <label for='prezime' class='form-label'>Prezime:</label>
                <input type='text' class='form-control <?php if(!empty($prezimeErr)) echo 'is-invalid'; ?>' id='prezime' name='prezime' value='<?php echo htmlspecialchars($prezime); ?>' required>
                <div class='invalid-feedback'><?php echo $prezimeErr;?></div>
            </div>
            <div class='mb-3'>
                <label for='lozinka1' class='form-label'>Lozinka:</label>
                <input type='password' class='form-control <?php if(!empty($lozinkaErr)) echo 'is-invalid'; ?>' id='lozinka1' name='lozinka1' required>
                <div class='invalid-feedback'><?php echo $lozinkaErr;?></div>
            </div>
            <div class='mb-3'>
                <label for='lozinka2' class='form-label'>Potvrdi lozinku:</label>
                <input type='password' class='form-control <?php if(!empty($lozinkaErr)) echo 'is-invalid'; ?>' id='lozinka2' name='lozinka2' required>
                <div class='invalid-feedback'><?php echo $lozinkaErr;?></div>
            </div>
            <div class="mb-3">
                <p>Već imate račun? <a href="prijava.php">Prijavite se</a>.</p>
            </div>
            <button type='submit' class='btn btn-primary'>Registriraj se</button>
        </form>
    </div><br>
</article>
</content>

<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p class="mb-0">&copy; 2024 Sopitas.com |  Vito Vdović  |  vvdovic@tvz.hr</p>
    </div>
</footer>

</body>
</html>
