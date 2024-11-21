<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Field</title>
    <link rel="stylesheet" href="public/css/new_exercise.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Exercise: de</h1>
        </header>
        <div class="fields-section">
            <h2>Fields</h2>
            <button class="complete-button">COMPLETE AND BE READY FOR ANSWERS</button>
        </div>
        <div class="new-field-section">
            <h2>New Field</h2>
            <form action="process.php" method="post">
                <label for="label">Label</label>
                <input type="text" id="label" name="label">
                
                <label for="value-kind">Value kind</label>
                <select id="value-kind" name="value-kind">
                    <option value="single-line">Single line text</option>
                    <option value="list-single-lines">List of single lines</option>
                    <option value="multi-line">Multi-line text</option>
                </select>
                
                <button type="submit">Submit</button>
            </form>
            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $label = $_POST['label'];
    $valueKind = $_POST['value-kind'];

    echo "Field created successfully!<br>";
    echo "Label: " . htmlspecialchars($label) . "<br>";
    echo "Value Kind: " . htmlspecialchars($valueKind);
}
?>

        </div>
    </div>
</body>
</html>
