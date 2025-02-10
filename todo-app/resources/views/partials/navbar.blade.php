<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top shadow-sm">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand fw-bolder text-uppercase" href="#">{{ config('app.name') }}</a>
        <form class="d-flex bg-light rounded-3 p-1" role="search" style="max-width: 300px;">
            <input class="form-control border-0 me-2" type="search" placeholder="Cari tugas..." aria-label="Search" style="box-shadow: none;">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</nav>