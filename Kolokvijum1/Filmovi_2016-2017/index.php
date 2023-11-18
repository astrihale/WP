<!DOCTYPE html>
<head>
    <title>Najgledaniji filmovi</title>
</head>
<body style="text-align: left; background-color: black; color: white;">
<?php
$fileContent = json_decode(file_get_contents("data.json"), true);
$godine = '';
foreach ($fileContent as $key => $value) {
    if ($godine !== '')
        $godine .= ", ";
    $godine .= $key;
}

echo "
<h1>Najbolje ocenjeni filmovi za: {$godine}</h1>
"
?>
<table style="padding: 5%;">
    <tr>
        <?php
        function formDescription($description): string
        {
            $style = $description === "" ? "background-color: red;" : "";

            return "
    <tr style='$style'>
        <th>Opis:</th>
        <th>$description</th>
    </tr>
    ";
        }

        function formMovie($movie): string
        {
            $title = $movie["title"];
            $originalPath = $movie["poster_path"];
            $description = $movie["overview"];
            $releaseDate = $movie["release_date"];
            $formDescription = formDescription($description);
            return "
    <div style='width: 100%;'>
        <h1 style='width: 100%; background: white; color: black; text-align: center;'>$title</h1>
        <img style='max-height: 50%; max-width: 50%;' src='https://image.tmdb.org/t/p/original$originalPath' alt='Failed to load movie poster...'>
        <table style='width: 100%; margin-top: 2%;'>
            <tr>
                <th>Izasao:</th>
                <th>$releaseDate</th>    
            </tr>
            {$formDescription}
        </table>
    </div>
    ";
        }

        foreach ($fileContent as $key => $data) {
            echo "<th style='max-width: 50%; height: 100%; margin-right: 100px; border: 5px solid white;'>";
            echo "<h1>$key</h1>";
            foreach ($data as $index => $movie) {
                echo formMovie($movie);
            }
            echo "</th>";
        }
        ?>
    </tr>
</table>
</body>
