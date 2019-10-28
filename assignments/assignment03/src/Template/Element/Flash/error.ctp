<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" onclick="this.classList.add('hidden');">
    <span class="block sm:inline"><?= $message ?></span>
</div>
