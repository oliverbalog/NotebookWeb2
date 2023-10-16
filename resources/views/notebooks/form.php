<div class="d-flex justify-content-center">
    <div>
        <div class="my-2 row">
            <div class="col">
                <label  for="manufacturer">Gyártó</label>
            </div>
            <div class="col">
                <input id="manufacturer" name="manufacturer" type="text"
                    value="<?php echo isset($notebook) ? $notebook['manufacturer'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label  for="type">Típus</label>
                </div>
                <div class="col">
                    <input id="type" name="type" type="text"
                        value="<?php echo isset($notebook) ? $notebook['type'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label  for="display">Kijelző</label>
                </div>
                <div class="col">
                    <input id="display" name="display" type="number" step="0.1"
                        value="<?php echo isset($notebook) ? $notebook['display'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label  for="memory">Memória mérete</label>
                </div>
                <div class="col">
                    <input id="memory" name="memory" type="number"
                        value="<?php echo isset($notebook) ? $notebook['memory'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label  for="harddisk">Merevlemez mérete</label>
                </div>
                <div class="col">
                    <input id="harddisk" name="harddisk" type="number"
                        value="<?php echo isset($notebook) ? $notebook['harddisk'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label  for="videocontroller">Grafikus gyorsító</label>
                </div>
                <div class="col">
                    <input id="videocontroller" name="videocontroller" type="text"
                        value="<?php echo isset($notebook) ? $notebook['videocontroller'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label  for="price">Ár</label>
                </div>
                <div class="col">
                    <input id="price" name="price" type="number"
                        value="<?php echo isset($notebook) ? $notebook['price'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label  for="pieces">Darabszám</label>
                </div>
                <div class="col">
                    <input id="pieces" name="pieces" type="number"
                        value="<?php echo isset($notebook) ? $notebook['pieces'] : null ?>" required <?php echo isset($disabled) ? 'disabled' : '' ?>>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label for="opsystem_id">Operációs rendszer</label>
                </div>
                <div class="col">
                    <select style="max-width: 185px" name="opsystem_id" id="opsystem_id" <?php echo isset($disabled) ? 'disabled' : '' ?>>
                        <?php foreach ($opsystems as $op) { ?>
                            <option value="<?php echo $op['id'] ?>" <?php if (isset($notebook) && $op['id'] == $notebook['opsystem_id'])
                                   echo 'selected' ?>>
                                <?php echo $op['os_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="my-2">
            <div class="row">
                <div class="col">
                    <label for="processor_id">Processor</label>
                </div>
                <div class="col">
                    <select style="max-width: 185px" name="processor_id" id="processor_id" <?php echo isset($disabled) ? 'disabled' : '' ?>>
                        <?php foreach ($processors as $proc) { ?>
                            <option value="<?php echo $proc['id'] ?>" <?php if (isset($notebook) && $proc['id'] == $notebook['processor_id'])
                                   echo 'selected' ?>>
                                <?php echo $proc['manufacturer'] . ' ' . $proc['type']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>