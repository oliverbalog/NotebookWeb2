<section>
    <div class="row">
        <div class="col">
            <h4>
                Új vélemény írása
            </h4>
            <form method="POST" action="<?php echo route($routes->get('news.store')); ?>" enctype=”multipart/form-data”>
                <div class="row mt-2 d-flex justify-content-center">
                    <div class="col-1">
                        <label for="title">Cím:</label>
                    </div>
                    <div class="col-3">
                        <input type="text" style="width: 100%;" name="title" id="title">
                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-center">
                    <div class="col-1">
                        <label for="title">Tartalom:</label>
                    </div>
                    <div class="col">
                        <textarea type="text" style="width: 100%;" name="content" id="content">
                        </textarea>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-2">
                    <div class="col-1">
                        <input type="submit" value="Hír beküldése" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>