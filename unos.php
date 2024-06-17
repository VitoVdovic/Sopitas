<!DOCTYPE html>
<?php session_start()?>
<html lang='hr'>
<head>
    <title> Unos </title>
    <meta http-equiv='content-type' content='text/html; charset=UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='Projekt pwa'>
    <meta name='keywords' content='programiranje, php, web, tvz'>
    <meta name='author' content='Vito Vdović'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="stil.css" type="text/css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <style>
        input.error,
        textarea.error,
        select.error {
            border: 1px dashed red;
        }

        .error {
            color: red;
            display: block;
            margin-top: 5px;
        }
    </style>
    <script>
        $(function() {
            $("#unosClanka").validate({
                rules: {
                    naslovVijesti: {
                        required: true,
                        minlength: 5,
                        maxlength: 30
                    },
                    kratkiSazetak: {
                        required: true,
                        minlength: 10,
                        maxlength: 50
                    },
                    tekstVijesti: {
                        required: true
                    },
                    kategorijaVijesti: {
                        required: true
                    },
                    odabirSlike: {
                        required: true
                    }
                },
                messages: {
                    naslovVijesti: {
                        required: "Naslov vijesti ne smije biti prazan",
                        minlength: "Naslov vijesti mora imati najmanje 5 znakova",
                        maxlength: "Naslov vijesti može imati najviše 30 znakova"
                    },
                    kratkiSazetak: {
                        required: "Kratki sadržaj vijesti ne smije biti prazan",
                        minlength: "Kratki sadržaj vijesti mora imati najmanje 10 znakova",
                        maxlength: "Kratki sadržaj vijesti može imati najviše 50 znakova"
                    },
                    tekstVijesti: {
                        required: "Tekst vijesti ne smije biti prazan"
                    },
                    kategorijaVijesti: {
                        required: "Molimo odaberite kategoriju"
                    },
                    odabirSlike: {
                        required: "Molimo odaberite sliku"
                    }
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.next("span"));
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
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
    <div class="mb-3" id="naslov_forme">
        <h1> Forma za unos članka </h1>
        <h2> Unesite podatke o vašem članku: </h2>
    </div>
    <article class="formaUnos">
        <div class="container mt-5">
            <form id="unosClanka" name="unosClanka" method="post" action="skripta.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="naslovVijesti" class="form-label">Naslov Vijesti:</label>
                    <input type="text" class="form-control" name="naslovVijesti" placeholder="Unesite naslov vijesti" autofocus>
                    <span class="error"></span>
                </div>
                <div class="mb-3">
                    <label for="kratkiSazetak" class="form-label">Kratki sadržaj vijesti (do 50 znakova):</label>
                    <textarea class="form-control" name="kratkiSazetak" rows="3" placeholder="Unesite kratki sažetak vijesti"></textarea>
                    <span class="error"></span>
                </div>
                <div class="mb-3">
                    <label for="tekstVijesti" class="form-label">Sadržaj Vijesti:</label>
                    <textarea class="form-control" name="tekstVijesti" rows="5" placeholder="Unesite tekst vijesti"></textarea>
                    <span class="error"></span>
                </div>
                <div class="mb-3">
                    <label for="kategorijaVijesti" class="form-label">Kategorija Vijesti</label>
                    <select class="form-select" name="kategorijaVijesti">
                        <option value="">Odaberite kategoriju</option>
                        <option value="MUSICA">Musica</option>
                        <option value="DEPORTES">Deportes</option>
                    </select>
                    <span class="error"></span>
                </div>
                <div class="mb-3">
                    <label for="odabirSlike" class="form-label">Slika:</label>
                    <input class="form-control" type="file" name="odabirSlike">
                    <span class="error"></span>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="prikazNaStranici" value="prihvaceno">
                    <label class="form-check-label" for="prikazNaStranici">
                        Prikaži na stranici
                    </label>
                </div>
                <button type="reset" class="btn btn-primary">Poništi</button>
                <button type="submit" class="btn btn-primary">Prihvati</button>
            </form>
        </div>
    </article>
</content>
<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p class="mb-0">&copy; 2024 Sopitas.com |  Vito Vdović  |  vvdovic@tvz.hr</p>
    </div>
</footer>

</body>
</html>
