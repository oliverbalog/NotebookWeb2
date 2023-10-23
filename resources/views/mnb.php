<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section>
    <div class="row">
        <h4 class="text-center">
            Magyar Nemzeti Bank - Átváltási árfolyamok
        </h4>
        <label>Árfolyam lekérdezése:</h3>

            <?php include_once APP_ROOT . '/resources/views/status.php' ?>
            <?php include_once APP_ROOT . '/resources/views/errors.php' ?>

            <form action="<?php echo route($routes->get('mnb.post')) ?>" method="POST">
                <input type="text" name="curr1" id="curr1" placeholder="Eredeti pénznem" required>
                <input type="text" name="curr2" id="curr2" placeholder="Átváltási pénznem" required>
                <button class="mt-2" type="submit">Átváltás</button>
            </form>
            <?php if (isset($data) && !empty($data)): ?>
                <div class="row mt-4">
                    <table>
                        <tr class="text-left font-bold">
                            <th>Eredeti pénznem</th>
                            <th>Átváltási pénznem</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $data['unit1'] . " " . $data['curr1']; ?>
                                </td>
                                <td>
                                    <?php echo $data['rate1'] . " " . $data['curr2']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $data['unit2'] . " " . $data['curr2']; ?>
                                </td>
                                <td>

                                    <?php echo $data['rate2'] . " " . $data['curr1']; ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="my-4">
                </div>
                <?php
            endif;
            include_once APP_ROOT . '/resources/views/mnbrates.php' ?>
    </div>
    <section>
        <?php
        include(APP_ROOT . "/resources/views/layouts/footer.php");
        ?>