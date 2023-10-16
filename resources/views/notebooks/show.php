<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
    <section>
        <div class="row">
            <h4 class="text-center"><?php echo isset($notebook) ? $notebook['manufacturer'].' '.$notebook['type'] : 'Hiba' ?></h4>

            <?php $disabled = true; ?>
			<?php include_once 'form.php' ?>

            <?php if(auth()->check()) : ?>
                <a class="link text-center my-4" href="<?php echo route($routes->get('notebooks.edit'), $notebook['id']); ?>">
                    Szerkesztés
                </a>
            <?php endif; ?>
        </div>
    </section>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>