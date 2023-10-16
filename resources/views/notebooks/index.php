<?php
include(APP_ROOT . "/resources/views/layouts/header.php");
?>
<section>
    <div class="row">
        <h4 class="text-center">
            Notebookok
        </h4>
        <?php if (auth()->check()): ?>
            <a class="text-center link mb-4" href="<?php echo route($routes->get('notebooks.create')); ?>">Hozzáadás</a>
        <?php endif; ?>

        <div class="overflow-x-scroll d-flex justify-content-center">
            <table cellpadding="10" cellspacing="10">
                <thead>
                    <tr class="text-left font-bold">
                        <th>#</th>
                        <th>Gyártó</th>
                        <th>Típus</th>
                        <th>Kijelző mérete</th>
                        <th>Merevlemez mérete</th>
                        <th>Grafikus gyorsító</th>
                        <th>Ár</th>
                        <th>Processzor</th>
                        <th>Operációs rendszer</th>
                        <th>Műveletek</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notebooks as $n) { ?>
                        <tr class="tr-class">
                            <td class="td-class">
                                    <?php echo $n['id']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['manufacturer']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['type']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['display']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['memory']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['harddisk']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['videocontroller']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['price']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['proc_manufacturer'] . ' ' . $n['proc_type']; ?>
                            </td>
                            <td class="td-class">
                                    <?php echo $n['os_name']; ?>
                            </td>
                            <td class="td-class">
                                <a
                                    href="<?php echo route($routes->get('notebooks.show'), $n['id']); ?>">
                                    Megtekintés
                                </a>
                            </td>
                            <?php if (auth()->check()): ?>
                                <td class="td-class">
                                    <a
                                        href="<?php echo route($routes->get('notebooks.edit'), $n['id']); ?>">
                                        Szerkesztés
                                    </a>
                                </td>
                                <td class="td-class">
                                    <a
                                        href="<?php echo route($routes->get('notebooks.delete'), $n['id']); ?>">
                                        Törlés
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


<?php
include(APP_ROOT . "/resources/views/layouts/footer.php");
?>