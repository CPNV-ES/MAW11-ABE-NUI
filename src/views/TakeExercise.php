<?php

//initialize page variables
$title = "ExerciseLooper";
$style = '<link rel="stylesheet" href="/css/Fulfillment.css">';

ob_start();
?>

<header class="heading answering">
    <section class="container">
        <a href="/"><img src="/img/logo.png" /></a>

    </section>
</header>

<main class="container">
    <ul class="ansering-list">
        <li class="row">
            <div class="column card">
                <div class="title">Test Fields</div>
                <a class="button" href="/exercises/108/fulfillments/new">Take it</a>
            </div>
        </li>
        <li class="row">
            <div class="column card">
                <div class="title">jdn</div>
                <a class="button" href="/exercises/115/fulfillments/new">Take it</a>
            </div>
        </li>
        <li class="row">
            <div class="column card">
                <div class="title">test555</div>
                <a class="button" href="/exercises/122/fulfillments/new">Take it</a>
            </div>
        </li>
        <li class="row">
            <div class="column card">
                <div class="title">hh</div>
                <a class="button" href="/exercises/124/fulfillments/new">Take it</a>
            </div>
        </li>
        <li class="row">
            <div class="column card">
                <div class="title"></div>
                <a class="button" href="/exercises/125/fulfillments/new">Take it</a>
            </div>
        </li>
        <li class="row">
            <div class="column card">
                <div class="title">jdn</div>
                <a class="button" href="/exercises/127/fulfillments/new">Take it</a>
            </div>
        </li>
    </ul>
</main>


<?php

$content = ob_get_clean();

require VIEW_DIR . "/Layout.php";
