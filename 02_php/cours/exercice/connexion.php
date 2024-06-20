<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
     <title>exercice php</title>
</head>
<body>
    <header class="col-12">
        <nav class="navbar  text-bg-secondary col-12">
            <div class="container col-6">
                
                <a href=""><p>LOGO</p></a>
                </a>
            </div>
            <div class="container d-flex justify-content-end justify-content-between col-6">
                <a href="index.php">Accueil</a>
                <a href="connexion.php">Connectez-vous</a>
                <a href="inscription.php">Inscription</a>
            </div>
        </nav>
    </header>
        <main class="container">
        <div class="bg-warning p-4 mb-5">
                <?php
                    echo '<pre>';
                    var_dump($_POST);
                    echo '</pre>';

                ?>

            </div>
        <form method="post">
        <div class="mb-3">
                <label for="exampleInputName" class="form-label">Nom</label>
                <input type="text" class="form-control" name="exampleInputName" id="exampleInputName">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="exampleInputEmail1" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="exampleInputPassword1" id="exampleInputPassword1">
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" name="exampleCheck1" for="exampleCheck1">Check me out</label>
            </div> -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        </main>

        

    

    <footer class="container d-flex justify-content-center">
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
        
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>