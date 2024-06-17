<!DOCTYPE html>
<html lang='hr'>
<head>
    <title> Administracija </title>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='Projekt pwa'>
    <meta name='keywords' content='programiranje, php, web, tvz'>
    <meta name='author' content='Vito Vdović'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
    <link href='stil.css' type='text/css' rel='stylesheet'/>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
    <style>
        .form-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-item {
            margin-bottom: 15px;
        }
        .form-item label {
            font-weight: bold;
        }
        .form-field-textual {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<?php
session_start();

if (!isset($_SESSION['korisnickoIme'])) {
    header('Location: prijava.php');
    exit();
}

include "connect.php";

$query = "SELECT razina FROM korisnik WHERE korisnickoIme = ?";
$stmt = mysqli_prepare($dbc, $query);

if (!$stmt) {
    die('Greška pri izvršavanju upita: ' . mysqli_error($dbc));
}

mysqli_stmt_bind_param($stmt, "s", $_SESSION['korisnickoIme']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die('Greška pri izvršavanju upita: ' . mysqli_error($dbc));
}

if (mysqli_num_rows($result) == 0) {
    // Ako korisnik nema odgovarajuću razinu pristupa
    header('Location: noaccess.php');
    exit();
}

$row = mysqli_fetch_assoc($result);
$razinaPristupa = $row['razina'];


if ($razinaPristupa != 1) {
    header('Location: noaccess.php');
    exit();
}
?>

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
                    <a class="nav-link active" href="administrator.php">Administracija</a>
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
    <div class='container'>
        <div class='mb-3' style='text-align:center; margin-top:15px;'>
            <h1> Administracija članka </h1>
        </div>
        <div class='row'>
            <div class='col-md-12'>
                <?php
                $query = "SELECT * FROM Clanak";
                $result = mysqli_query($dbc, $query);
                if (isset($_POST['delete'])) {
                    $id = $_POST['id'];
                    $deleteQuery = "DELETE FROM Clanak WHERE id = ?";
                    $stmt = mysqli_prepare($dbc, $deleteQuery);
                    mysqli_stmt_bind_param($stmt, "i", $id);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success' role='alert'>Članak uspješno obrisan!</div>";
                }

                if (isset($_POST['update'])) {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $about = $_POST['about'];
                    $content = $_POST['content'];
                    $category = $_POST['category'];
                    $archive = isset($_POST['archive']) ? 1 : 0;

                    if (isset($_FILES['photo']) && $_FILES['photo']['size'] > 0) {
                        $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
                        $updateQuery = "UPDATE Clanak SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
                        $stmt = mysqli_prepare($dbc, $updateQuery);
                        mysqli_stmt_bind_param($stmt, "ssssiii", $title, $about, $content, $photo, $category, $archive, $id);
                    } else {
                        $updateQuery = "UPDATE Clanak SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?";
                        $stmt = mysqli_prepare($dbc, $updateQuery);
                        mysqli_stmt_bind_param($stmt, "ssssii", $title, $about, $content, $category, $archive, $id);
                    }

                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success' role='alert'>Članak uspješno ažuriran!</div>";
                }

                while ($row = mysqli_fetch_array($result)) {
                    echo '<div class="form-container">';
                    echo '<form enctype="multipart/form-data" action="" method="POST">
                        <div class="form-item">
                            <label for="title">Naslov članka:</label>
                            <input type="text" name="title" class="form-field-textual" value="'.$row['naslov'].'">
                        </div>
                        <div class="form-item">
                            <label for="about">Kratki sadržaj vijesti (do 50 znakova):</label>
                            <textarea name="about" cols="30" rows="3" class="form-field-textual">'.$row['sazetak'].'</textarea>
                        </div>
                        <div class="form-item">
                            <label for="content">Sadržaj vijesti:</label>
                            <textarea name="content" cols="30" rows="10" class="form-field-textual">'.$row['tekst'].'</textarea>
                        </div>
                        <div class="form-item">
                            <label for="photo">Slika:</label>
                            <input type="file" class="form-control" id="photo" name="photo"/>
                            <br>
                            <img src="data:image/jpeg;base64,'.base64_encode($row['slika']).'" width="100px">
                        </div>
                        <div class="form-item">
                            <label for="category">Kategorija vijesti:</label>
                            <select name="category" class="form-select">
                                <option value="DEPORTES" '.($row['kategorija'] == 'DEPORTES' ? 'selected' : '').'>Deportes</option>
                                <option value="MUSICA" '.($row['kategorija'] == 'MUSICA' ? 'selected' : '').'>Musica</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <label>Spremiti u arhivu:</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="archive" '.($row['arhiva'] == 1 ? 'checked' : '').'>
                                <label class="form-check-label" for="archive">Arhiviraj?</label>
                            </div>
                        </div>
                        <div class="form-item text-center">
                            <input type="hidden" name="id" value="'.$row['id'].'">
                            <button type="reset" class="btn btn-secondary">Poništi</button>
                            <button type="submit" name="update" class="btn btn-primary">Izmjeni</button>
                            <button type="submit" name="delete" class="btn btn-danger">Izbriši</button>
                        </div>
                    </form>';
                    echo '</div>';
                }
                mysqli_close($dbc);
                ?>
            </div>
        </div>
    </div>
    <footer class='bg-dark text-white text-center py-3'>
        <div class='container'>
            <p class='mb-0'>&copy; 2024 Sopitas.com | Vito Vdović | vvdovic@tvz.hr</p>
        </div>
    </footer>
</body>
</html>
