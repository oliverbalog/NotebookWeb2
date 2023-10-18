<div class="ratings">
    <?php
    $any = array_search($n["id"], array_column($ratings, "news_id"));
    if (isset($n) && $any)
    ?>
    <div class="row d-flex justify-content-end mt-2">
        Vélemények
    </div>
    <?php
    foreach ($ratings as $rating) {
        if (isset($n) && $n['id'] == $rating['news_id']) {
            ?>
            <div class="row">
                <div class="col">
                    <?php
                    echo $rating["rating"]
                        ?>
                    <?php
                    for ($i = 0; $i < $rating["rating"]; $i++) {
                        ?>
                        <img src="/images/star.png" style="width: 10px;" />
                        <?php
                    }
                    ?>
                </div>
                <div class="col-4">
                    <?php
                    foreach ($users as $user) {
                        if (isset($rating) && $rating['rated_by'] == $user['id']) {
                            echo $user["name"];
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="row mb-4">
                    <div class="col-4">
                        <?php echo $rating["text_rate"]; ?>
                    </div>
            </div>

        <?php } ?>

    <?php } ?>

</div>