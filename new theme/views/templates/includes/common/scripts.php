
<?php 


if (!empty($scripts) && count($scripts) > 0): ?>
    <?php foreach ($scripts as $script): ?>
        <script src="<?php echo $script; ?>"></script>
    <?php endforeach ?>
<?php endif ?>