<?php

//initialize page variables
$title = "ExerciseLooper";

ob_start();
?>
<h1>Exercise Looper</h1>
<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
