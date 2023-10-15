<div class="container-fluid d-flex justify-content-end ">
    <div class="d-none d-md-block pt-2 " style="margin-bottom: -10px">
        <ul type="none" id="bars_large">
            <?php include "lista.php" ?>
        </ul>
    </div>

    <div class="d-flex d-md-none pt-2 pb-2 ">
        <i class="fas fa-bars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft"
            style="cursor: pointer; font-size: 40px; color: #056a9a; border: 3px solid; padding: 5px;"></i>
    </div>
</div>

<div class="offcanvas offcanvas-start" style="width: 60%" tabindex="-1" id="offcanvasLeft"
    aria-labelledby="offcanvasLeftLabel">

    <div class="offcanvas-header">
        <h5 id="offcanvasLeftLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul type="none" id="bars_small">
            <?php include "lista.php" ?>
        </ul>
    </div>
</div>