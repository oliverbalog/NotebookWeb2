<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section>
    <div class="row">
        <h4 class="d-flex justify-content-center my-4">Notebook hozzáadása</h4>

		<?php include_once APP_ROOT . '/resources/views/errors.php' ?>

        <form method="POST" action="<?php echo route($routes->get('notebooks.store')); ?>" enctype=”multipart/form-data”>

            <?php include_once 'form.php' ?>

            <div class="d-flex justify-content-center">
                <button type="submit" class="my-2">
                    Hozzáadás
                </button>
            </div>
        </form>
    </div>
</section>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>