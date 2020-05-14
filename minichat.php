<?php
session_start();

include("pdo.php");

// Récupération des 10 derniers messages
$preparedRequest = $PDO->query(
    "SELECT username, message " .
        "FROM minichat " .
        "ORDER BY ID DESC " .
        "LIMIT 0, 10 "
);

$allMessages = $preparedRequest->fetchAll();
$username = $_SESSION['username'];
$preparedRequest->closeCursor();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Poppins&family=Roboto&display=swap" rel="stylesheet">

    <title>MiniChat</title>
</head>

<body class="bg-dark " style="background-image: url(https://images.unsplash.com/photo-1494592018820-f954535166d7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2133&q=80)">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark border-bottom border-light">
        <div class="container">
            <h2 class="text-light font-weight-bold ml-3"> <svg class="bi bi-chat-square-dots text-light" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v8a1 1 0 001 1h2.5a2 2 0 011.6.8L8 14.333 9.9 11.8a2 2 0 011.6-.8H14a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v8a2 2 0 002 2h2.5a1 1 0 01.8.4l1.9 2.533a1 1 0 001.6 0l1.9-2.533a1 1 0 01.8-.4H14a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd" />
                    <path d="M5 6a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0zm4 0a1 1 0 11-2 0 1 1 0 012 0z" />
                </svg> MiniChat</h2>

            <!-- Bouton déconnexion -->
            <?php if (isset($_SESSION['username'])) { ?>
                <div>
                    <a class="btn btn-light text-right mr-3" href="minichat_logout.php" role="button"><svg class="bi bi-power" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.578 4.437a5 5 0 104.922.044l.5-.866a6 6 0 11-5.908-.053l.486.875z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M7.5 8V1h1v7h-1z" clip-rule="evenodd" />
                        </svg> Sign out </a>
                </div>
            <?php } ?>
        </div>
    </nav>

    <!-- Main page -->
    <div class="container">
        <div class="row mx-auto">

            <!-- Afficher le chat-->
            <div class="col-sm-12 col-md-8 mt-5">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h4 class="mb-1 text-muted">Latest messages:</h4>
                    </div>
                </a>
                <?php
                foreach ($allMessages as $oneMessage) { ?>
                    <a href="#" class="list-group-item list-group-item-action shadow">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 font-weight-bold"><?php echo htmlspecialchars($oneMessage['username']) ?> </h5>
                        </div>
                        <p class="mb-1 font-italic"><?php echo htmlspecialchars($oneMessage['message']) ?> </p>
                    </a>
                <?php } ?>
            </div>

            <!-- FORMULAIRE -->
            <div class="col-sm-12 col-md-4">
                <!-- Si l'utlisateur est connecté, on affiche le formulaire pour envoyer un message -->
                <?php if (isset($_SESSION['username'])) { ?>

                    <div class="card p-5 mt-5 shadow mb-5 bg-white rounded text-center">
                        <form method="POST" action="minichat_post.php">
                            <h5 class="text-muted">Welcome back <?php echo $username ?>!</h5>
                            <div class="form-group">
                                <label for="messageInput"></label>
                                <textarea class="form-control" id="messageInput" rows="3" name="message" placeholder="Your message"></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-block btn-secondary">Send</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <!-- Sinon, on affiche le formulaire de login -->
    <?php
                } else {
    ?>
        <div class="card p-5 mt-5 shadow mb-5 bg-white rounded text-center">
            <form method="POST" action="minichat_login.php">
                <h3 class="text-muted">Sign in</h3>
                <svg class="bi bi-box-arrow-in-right text-muted" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.146 11.354a.5.5 0 010-.708L10.793 8 8.146 5.354a.5.5 0 11.708-.708l3 3a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9A.5.5 0 011 8z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M13.5 14.5A1.5 1.5 0 0015 13V3a1.5 1.5 0 00-1.5-1.5h-8A1.5 1.5 0 004 3v1.5a.5.5 0 001 0V3a.5.5 0 01.5-.5h8a.5.5 0 01.5.5v10a.5.5 0 01-.5.5h-8A.5.5 0 015 13v-1.5a.5.5 0 00-1 0V13a1.5 1.5 0 001.5 1.5h8z" clip-rule="evenodd" />
                </svg>
                <div class="form-group">
                    <label for="usernameInput"></label>
                    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="passwordInput"></label>
                        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password"></textarea>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-block btn-secondary">Login</button>
                    </div>
            </form>
        </div>
    <?php } ?>
    </div>
    </div>

    <!-- footer -->
    <footer class=" fixed-bottom bg-dark border-top border-light border-top">
        <p class=" text-center text-light my-3" href="#">&copy; 2020 - BlackCat</p>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>