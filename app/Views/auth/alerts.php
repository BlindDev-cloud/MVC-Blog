<?php
$alerts = App\Helpers\SessionHelper::getAlerts();
$alerts = array_unique($alerts, SORT_REGULAR);
?>
<div class="row my-3">
    <?php if (!empty($alerts)): ?>
        <?php foreach ($alerts as $alert): ?>
            <p class="w-100 alert bg-<?= $alert['type']; ?>">
                <?= $alert['message']; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>