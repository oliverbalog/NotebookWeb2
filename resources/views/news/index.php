<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>

<section>
    <div class="row">
        <h4 class="text-center">
            Hírek
        </h4>

        <?php foreach ($news as $n) { ?>
            <div class="row d-flex justify-content-start">
                <div class="new px-4 mx-4">
                    <div class="row news-title">
                        <?php echo $n['title']; ?>
                    </div>
                    <div class="row content">
                        <div class="col-10">
                            <?php echo $n['content']; ?>
                        </div>
                        <div class="col meta-info">
                            <div class="row d-flex justify-content-end">
                                <?php echo $n['username']; ?>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <?php echo $n['created_at']; ?>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <?php include(APP_ROOT . "/resources/views/news/ratings.php"); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <form method="POST" action="<?php echo route($routes->get('news.rate'), $n['id']); ?>" enctype=”multipart/form-data”>
                            <div class="row mt-2 d-flex justify-content-center">
                                <div class="col-1 d-flex align-items-center justify-content-end">
                                    <select name="rating" id="rating">
                                        <?php
                                        for ($i = 1; $i < 6; $i++) {
                                            ?>
                                            <option value="<?php echo $i ?>">
                                                <?php echo $i;
                                                ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" style="width: 100%;" name="text_rate" id="text_rate">
                                </div>
                                <div class="col-2">
                                    <input type="submit" value="Vélemény küldése" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>


            <?php include(APP_ROOT . "/resources/views/news/create.php"); ?>
    </div>
</section>


<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>