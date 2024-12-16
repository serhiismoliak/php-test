<!DOCTYPE html> 
<html lang="uk"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Перевірка дати за допомогою регулярного виразу</title> 
    <style> 
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f4f4f9; 
            margin: 20px; 
            color: #333; 
        } 
        h1, h2 { 
            text-align: center; 
        } 
        .info, .result { 
            text-align: center; 
            margin-bottom: 20px; 
        } 
        .form-container { 
            width: 50%; 
            margin: 0 auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 10px; 
            background-color: #e8f5e9; 
        } 
        input, label { 
            margin: 10px 0; 
            display: block; 
        } 
        input[type="radio"], input[type="checkbox"] { 
            display: inline-block; 
        } 
        .result div { 
            margin: 10px; 
            padding: 10px; 
            border: 1px solid #999; 
            border-radius: 5px; 
            display: inline-block; 
            background-color: #f1f8e9; 
        } 
        footer { 
            text-align: center; 
            margin-top: 30px; 
            color: #555; 
        } 
    </style> 
</head> 
<body> 
    <h1>Перевірка дати у форматі dd/mm/yyyy</h1> 
    <!-- PHP-обробник --> 
                
            <div class="qwe-content" style="text-align: center; margin-top: 50px;"> 
    <h3>Перевірка дати (1600-9999)</h3> 
    <form method="POST"> 
        <div style="display: flex; justify-content: center; align-items: center;"> 
            <input type="text" name="dateInput" placeholder="Введіть дату (dd/mm/yyyy)" style="margin-right: 10px;"> 
            <button type="submit">Перевірити</button> 
        </div> 
    </form> 
    <p id="dateResult" style="font-weight: bold; color: red;"> 
        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $date = $_POST['dateInput']; 
 
            // Шаблон для перевірки дати у форматі dd/mm/yyyy 
            $datePattern = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/((16|17|18|19|[2-9]\d)\d{2})$/'; 
 
            if (preg_match($datePattern, $date)) { 
                // Розбиваємо дату на частини для додаткової перевірки 
                [$day, $month, $year] = explode('/', $date); 
                $day = (int)$day; 
                $month = (int)$month; 
                $year = (int)$year; 
 
                // Перевірка дня у місяці 
                function validateDate($day, $month, $year) { 
                    $daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]; 
 
                    // Врахування високосного року 
                    if ($month === 2) { 
                        $isLeapYear = ($year % 4 === 0 && $year % 100 !== 0) || ($year % 400 === 0); 
                        return $day <= ($isLeapYear ? 29 : 28); 
                    } 
 
                    // Перевірка дня для інших місяців 
                    return $day <= $daysInMonth[$month - 1]; 
                } 
 
                if (validateDate($day, $month, $year)) { 
                    echo '<span style="color: green;">Коректна дата!</span>'; 
                } else { 
                    echo '<span style="color: red;">Некоректна дата!</span>'; 
                } 
            } else { 
                echo '<span style="color: red;">Некоректний формат дати!</span>'; 
            } 
        } 
        ?> 
    </p> 
</div> 
            
 
    <footer> 
        &copy; 2024, Олійник С. І. | Всі права захищено. 
    </footer> 
</body> 
</html>