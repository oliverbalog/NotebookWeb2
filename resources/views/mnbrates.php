<section>
    <div class="row">
        <label>Átváltási árfolyamok adott dátumra:</label>

        <form action="<?php echo route($routes->get('mnb.rates')) ?>" method="POST">
            <input type="text" name="curr1" id="curr1" placeholder="Eredeti pénznem" required>
            <input type="text" name="curr2" id="curr2" placeholder="Átváltási pénznem" required>
            <input type="date" name="startDate" id="startDate" placeholder="Árfolyam időszak kezdete" required>
            <input type="date" name="endDate" id="endDate" placeholder="Árfolyam időszak vége" required>
            <button class="mt-2" type="submit">Árfolyamok megtekintése</button>
        </form>

        <?php if (isset($resultData) && !empty($resultData)): ?>
            <div class="row my-2 justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <button onclick="chart()" value="Diagram">Diagram</button>
                </div>

                    <canvas id="chart" width="400" height="100" aria-label="" role="img"></canvas>

            </div>

            <div class="row mt-4">
                <table>
                    <tr class="text-left font-bold">
                        <th>Eredeti pénznem</th>
                        <th>Átváltási pénznem</th>
                        <th>Árfolyam</th>
                        <th>Dátum</th>
                    </tr>
                    <tbody>
                        <?php foreach ($resultData as $rate) {
                            ?>
                            <tr>
                                <td class="curr1">
                                    <?php echo $rate['curr1']; ?>
                                </td>
                                <td class="curr2">
                                    <?php echo $rate['curr2']; ?>
                                </td>
                                <td class="rate">
                                    <?php echo $rate['rate']; ?>
                                </td>
                                <td class="date">
                                    <?php echo $rate['date']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>