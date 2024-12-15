<?php

$a = [1, 3, 5, 7, 9, 11, 13, 15, 17, 19];
$b = [2, 6, 10, 14, 18, 22, 26, 30, 34, 38];
$c = [46, 41, 36, 31, 26, 21, 16, 11, 6, 1];
$x = [4, 7, 10, 13, 16, 19, 22, 25, 28, 31];


$initialWidth = 45;
$initialHeight = 27;
$colorStep = 7;
$blockCount = count($a);
$colors = 9;


function calculateY($a, $b, $c, $x) {
    return $a * pow($x, 2) + pow(pow($c, 2), 1/3) + atan($b) + exp(max($a, $b));
}


function formatNumber($number) {
    if (strlen((string) floor(abs($number))) > 12) {
        return sprintf("%.5e", $number); 
    }
    return round($number, 5);
}


$author = "Смоляк Сергій Володимирович";
$group = "СБ-32";
$creationDate = date("d.m.Y");
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Табуляція функції</title>
    <style>
        /* General Page Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }
        h2 {
            margin-top: 0;
        }
        .author-info {
            text-align: center;
            margin: 10px 0;
            font-size: 1.1rem;
            color: #555;
        }
        .formula-container {
            text-align: center;
            margin: 20px;
        }
        .formula-container img {
            max-width: 100%;
            height: auto;
        }
        .blocks-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px auto;
            max-width: 1200px;
        }
        .block {
            display: inline-block;
            text-align: center;
            padding: 5px 0px;
            box-sizing: border-box;
            overflow: hidden;
            text-overflow: white-place;
            margin: 5px;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            border: 3px solid;
            border-radius: 8px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        footer {
            text-align: center;
            margin: 20px 0;
            font-size: 1rem;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Табуляція функції</h1>
    <div class="formula-container">
        <img src="formula.png" alt="Формула функції">
    </div>

    <h2>Результати обчислень</h2>
    <div class="blocks-container">
        <?php
        $index = 0;
        $width = $initialWidth;
        $height = $initialHeight;
        $color = 9;

        while ($index < $blockCount) {
            $currentA = $a[$index];
            $currentB = $b[$index];
            $currentC = $c[$index];
            $currentX = $x[$index];


            $y = calculateY($currentA, $currentB, $currentC, $currentX);
            $formattedY = formatNumber($y);

            $rgbColor = "rgb($color, " . ($color + 30) % 255 . ", " . ($color + 60) % 255 . ")";

            echo "<div class='block' style='font-size: 12px; width: {$width}px; height: {$height}px; background-color: {$rgbColor}; border-color: {$rgbColor};'>
                {$formattedY}
            </div>";

            
            $width += 10;
            $height += 5;
            $color += $colorStep;
            $index++;
        }
        ?>
    </div>

    <div class="author-info">
        <p><strong>Розробник:</strong> <?php echo $author; ?></p>
        <p><strong>Група:</strong> <?php echo $group; ?></p>
        <p><strong>Дата створення:</strong> <?php echo $creationDate; ?></p>
    </div>
</body>
</html>
