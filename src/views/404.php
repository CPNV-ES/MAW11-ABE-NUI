<?php

//initialize page variables
$title = "404 error";

ob_start();
?>
<p>404 Error</p>
<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
