<?php

//initialize page variables
$title = "ExerciseLooper";
$style =  '<link rel="stylesheet" href="/css/create_style.css">';
ob_start();

?>


<header>
    <div class="logo-container">
        <!-- Le logo qui renvoie à la page d'accueil -->
        <a href="home.php">
            <img src="/img/logo.png" alt="Logo" class="logo">
        </a>
    </div>
    <h1>New Exercise</h1>
</header>
<main>
    <form action="/exercises" method="POST" class="exercise-form">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>

        <button type="submit" class="btn purple">Create Exercise</button>
    </form>
</main>


<?php

$content = ob_get_clean();

require VIEW_DIR . "/layout.php";
