<?php

$E = [
    [-1.2, -7.2, -1.1, 4.2],
    [6.2, -8.7, 3.2, 1.4],
    [11.2, -5.1, 6.3, -4.2],
    [2.1, 3.1, -2.1, 3.1]
];

$flattenedE = array_merge(...$E);

// Знаходимо всі від'ємні елементи
$negatives = array_filter($flattenedE, function($value) {
    return $value < 0;
});

// Максимальний від'ємний елемент
$maxNegative = max($negatives);

// Створюємо нову матрицю відхилень
$newMatrix = [];
foreach ($flattenedE as $value) {
    $newMatrix[] = $value - $maxNegative;
}

// Знаходимо кількість від'ємних відхилень та їх добуток
$negativeDeviations = array_filter($newMatrix, function($value) {
    return $value < 0;
});

$negativeCount = count($negativeDeviations);
$negativeProduct = array_product($negativeDeviations);

// Обчислюємо кубічний корінь із добутку від'ємних відхилень
$cubicRootNegative = $negativeProduct < 0 ? -pow(abs($negativeProduct), 1/3) : pow($negativeProduct, 1/3);

// Знаходимо суму додатних відхилень та квадратний корінь
$positiveDeviations = array_filter($newMatrix, function($value) {
    return $value > 0;
});

$positiveSum = array_sum($positiveDeviations);
$squareRootPositive = sqrt($positiveSum);

// Функція для форматування чисел
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
    <title>Матриця відхилень</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }
        table.matrix-table {
            margin: 20px auto;
            border-collapse: collapse;
        }
        table.matrix-table td {
            border: 2px solid #2c3e50;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            color: #2c3e50;
            background-color: #eaf4f9;
            font-size: 14px;
        }
        .results {
            padding: 20px;
            max-width: 500px;
            margin: 20px auto;
            text-align: left;
            font-size: 1.1rem;
            color: #333;
            color: #777;
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
    <h1>Початкова матриця</h1>
    <table class="matrix-table">
        <?php
        for ($i = 0; $i < count($flattenedE); $i++) {
            if ($i % 4 == 0) echo "<tr>";
            echo "<td>{$flattenedE[$i]}</td>";
            if (($i + 1) % 4 == 0) echo "</tr>";
        }
        ?>
    </table>

    <h1>Нова матриця відхилень</h1>
    <table class="matrix-table">
        <?php
        for ($i = 0; $i < count($newMatrix); $i++) {
            if ($i % 4 == 0) echo "<tr>";
            echo "<td>" . formatNumber($newMatrix[$i]) . "</td>";
            if (($i + 1) % 4 == 0) echo "</tr>";
        }
        ?>
    </table>

    <div class="results">
        <p>Кількість від'ємних відхилень: <?php echo $negativeCount; ?></p>
        <p>Добуток від'ємних відхилень: <?php echo formatNumber($negativeProduct); ?></p>
        <p>Кубічний корінь із добутку від'ємних відхилень: <?php echo formatNumber($cubicRootNegative); ?></p>
        <p>Квадратний корінь суми додатних відхилень: <?php echo formatNumber($squareRootPositive); ?></p>
    </div>

    <footer>
        <p><strong>Розробник:</strong> <?php echo $author; ?></p>
        <p><strong>Група:</strong> <?php echo $group; ?></p>
        <p><strong>Дата створення:</strong> <?php echo $creationDate; ?></p>
    </footer>
</body>
</html>
