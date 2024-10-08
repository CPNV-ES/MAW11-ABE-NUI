<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Exercise</title>
    <link rel="stylesheet" href="Fields.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <img src="logo.png" alt="Exercise Looper Logo" class="logo">
            <span>New exercise</span>
        </div>
    </header>

    <div class="container">
        <div class="left-panel">
            <h2>Fields</h2>
            <table>
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Value kind</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button class="btn purple">Complete and be ready for answers</button>
        </div>

        <div class="right-panel">
            <h2>New Field</h2>
            <form>
                <label for="label">Label</label>
                <input type="text" id="label" name="label">

                <label for="value-kind">Value kind</label>
                <select id="value-kind" name="value-kind">
                    <option value="single-line">Single line text</option>
                </select>

                <button type="submit" class="btn purple">Create Field</button>
            </form>
        </div>
    </div>
</body>
</html>
