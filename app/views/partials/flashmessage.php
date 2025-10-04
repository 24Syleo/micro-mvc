<?php

use App\services\FlashMessage;

$flash = FlashMessage::get();
if ($flash): ?>
    <div class="container mt-3">
        <div class="text-center alert alert-<?= e($flash['type']) ?>">
            <?= e($flash['message']) ?>
        </div>
    </div>
<?php endif; ?>