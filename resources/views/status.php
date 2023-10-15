<?php if (isset($_SESSION['status']) && !empty($_SESSION['status'])) { ?>
    <div class="row d-flex justify-content-center">
        <div class="col-6 center-block text-center my-4 alert alert-success">
            <p>
                <?php echo $_SESSION['status']; ?>
            </p>
        </div>
    </div>
    <?php
    unset($_SESSION['status']);
}
?>