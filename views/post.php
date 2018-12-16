<?php

$content = <<<EOT
<div class="row">
    <div class="col-lg-12 post">
        <h2>{$post['subject']}</h2>
        <p>{$post['message']}</p>
    </div>
</div>
EOT;


require_once ('layout.php');