<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section>
    <div class="row">


        <h4 class="text-center mb-4">Bejelentkezés</h4>

        <?php include_once APP_ROOT . '/resources/views/status.php' ?>
        <?php include_once APP_ROOT . '/resources/views/errors.php' ?>

        <div class="col-12 d-flex justify-content-center">
        <form class="text-center" action="<?php echo route($routes->get('login.post')) ?>" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" />
                <label class="form-label" for="email">E-mail cím</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="pwd">Jelszó</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Bejelentkezés</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Még nincs felhasználója? <a href="#!">Regisztráljon itt!</a></p>
            </div>
        </form>
        </div>


    </div>
</section>
<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>