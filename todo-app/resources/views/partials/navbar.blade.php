<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top shadow-sm">
    <div class="container d-flex justify-content-between">
        <div class="d-flex align-items-center">
            
            <a class="navbar-brand fw-bolder text-uppercase" href="#">{{ config('app.name') }}</a>
        </div>
        <form class="d-flex bg-light rounded-3 p-1" role="search" style="max-width: 300px; background-color: #af32af;">
            <input class="form-control border-0 me-2" type="search" placeholder="Cari tugas..." aria-label="Search" style="box-shadow: none; background-color: #ffebef;">
            <button class="btn text-white" type="submit" style="background-color: #ff69b4;">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</nav>