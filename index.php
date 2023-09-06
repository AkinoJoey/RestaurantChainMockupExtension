<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    
    <title>Restaurant Chain Mockup</title>
</head>
<body>
    <main class="container">
        <h3 style="text-align: center;">Restaurant Chain Mockup</h3>
        <form action="download.php" method="post">
                <label for="numberOfEmployees"><strong>Number of Employees</strong></label>
                <input type="number" id="numberOfEmployees" name="numberOfEmployees" min="1" max="100" value="5">

                <label><strong>Salary Range</strong></label>
                <label for="minSalary">Min:</label>
                <input type="number" id="minSalary" name="minSalary"  value="100">
                <label for="maxSalary">Max:</label>
                <input type="number" id="maxSalary" name="maxSalary"  value="10000">
            

                <label><strong>Zip Code Range</strong></label>
                <label for="startZipCode">Start:</label>
                <input type="number" id="startZipCode" name="startZipCode"  value="00000">
                <label for="endZipCode">End:</label>
                <input type="number" id="endZipCode" name="endZipCode"  value="99999">
            

                <label for="format"><strong>Download Format</strong></label>
                <select id="format" name="format">
                    <option value="html" selected>HTML</option>
                    <option value="markdown">Markdown</option>
                    <option value="json">JSON</option>
                    <option value="txt">Text</option>
                </select>

                <button type="submit">Generate</button>
        </form>
    </main>
</body>
</html>
