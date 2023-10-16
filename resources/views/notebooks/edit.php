<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section>
    <div class="row">
        <h4 class="text-center my-4">
            <?php echo isset($notebook) ? $notebook['manufacturer'] . ' ' . $notebook['type'] : 'Hiba' ?> Szerkesztése
        </h4>

        <?php include_once APP_ROOT . '/resources/views/errors.php' ?>

        <form method="POST" action="<?php echo route($routes->get('notebooks.update'), $notebook['id']); ?>"
            enctype=”multipart/form-data”>

            <?php include_once 'form.php' ?>

            <div>
                <div class="d-flex justify-content-center my-2">
                    <a class="text-red-600 link"
                        href="<?php echo route($routes->get('notebooks.delete'), $notebook['id']); ?>">Törlés</a>
                </div>
                <div class="d-flex justify-content-center my-2">
                    <button type="submit">
                        Mentés
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>