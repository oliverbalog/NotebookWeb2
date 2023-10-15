<?php if (isset($errors) && !empty($errors)) { ?>
    <div class="row d-flex justify-content-center">
        <div class="col-6 center-block text-center my-4 alert alert-warning">
            <?php echo $errors ?>
        </div>
    </div>
<?php } ?>