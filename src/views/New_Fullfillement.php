<?php
$fulfillments = [
    ['date' => '2024-10-01 09:19:58 UTC', 'show' => '#', 'edit' => '#', 'destroy' => '#'],
    ['date' => '2024-10-02 11:36:15 UTC', 'show' => '#', 'edit' => '#', 'destroy' => '#'],
    ['date' => '2024-10-02 11:37:23 UTC', 'show' => '#', 'edit' => '#', 'destroy' => '#'],
    // Ajoute autant d'entrées que tu veux ici
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fulfillments for Test Fields</title>
    <link rel="stylesheet" href="New_Fullfillement.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Exercise: <span>Test Fields</span></h1>
        </div>
        <div class="success-message">
            Field was successfully created.
        </div>
    </header>

    <main>
        <h2>Fulfillments for Test Fields</h2>
        <table>
            <thead>
                <tr>
                    <th>Taken at</th>
                    <th>Show</th>
                    <th>Edit</th>
                    <th>Destroy</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fulfillments as $fulfillment): ?>
                <tr>
                    <td><?php echo $fulfillment['date']; ?></td>
                    <td><a href="<?php echo $fulfillment['show']; ?>">Show</a></td>
                    <td><a href="<?php echo $fulfillment['edit']; ?>">Edit</a></td>
                    <td><a href="<?php echo $fulfillment['destroy']; ?>">Destroy</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
