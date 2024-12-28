<nav id="menu" class="navbar navbar-expand-lg navbar-light bg-light py-3 position-fixed w-100 z-1">
    <div class="container">
        <a class="navbar-brand fw-bold" href='index.php'>Partage de recettes</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toogle navigation">
            <span class="navbar-toggle-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center">
                <li class="nav-item">
                    <a href="index.php" class="nav-link active" aria-current="page">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link">Contact</a>
                </li>
                <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
                <li class="nav-item">
                    <a href="login.php" class="nav-link">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a href="register.php" class="nav-link">S'inscrire</a>
                </li>
                <?php endif ; ?>
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Deconnexion</a>
                </li>
                <?php endif ; ?>
            </ul>
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                    <li class="btn btn-danger border-light rounded-5">
                        <a href="recipes_create.php" class="nav-link">Ajouter une recette</a>
                    </li>
                <?php endif ; ?>
            </div>
        </div>
    </div>
</nav>