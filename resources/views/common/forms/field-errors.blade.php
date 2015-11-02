<?php if ($errors) { ?>
    <ul class="field-errors">
        <?php foreach ($errors as $error) { ?>
            <li><?php echo $error ?></li>
        <?php } ?>
    </ul>
<?php } ?>
