<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="<?= base_url('/'); ?>">Home</a>
                <a class="nav-link" href="<?= base_url('pages/about'); ?>">About</a>
                <a class="nav-link" href="<?= base_url('pages/contact'); ?>">Contact</a>
                <a class="nav-link" href="<?= base_url('komiks/index'); ?>">Komik</a>
            </div>
        </div>
    </div>
</nav>