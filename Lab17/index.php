<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Validation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
        }
        label, input, button {
        label, button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input {
            display: block;
            width: -webkit-fill-available;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .normal {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error {
            padding: 8px;
            font-size: 16px;
            border: 2px solid red;
            border-radius: 4px;
            background-color: #ffe6e6;
        }
        .success {
            padding: 8px;
            font-size: 16px;
            border: 2px solid green;
            border-radius: 4px;
            background-color: #e6ffe6;
        }
    </style>
</head>
<body>
<?php
$inputClass = "normal";
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['passwordInput'];
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/";
    if (preg_match($pattern, $password)) {
        $inputClass = "success";
        $message = "<span style='color: green'>Пароль є правильним</span>";
    } else {
        $inputClass = "error";
        $message = "<span style='color: red'>Пароль є неправильним</span>";
    }
}
?>

<form method="POST">
    <label for="password">Пароль:</label>
    <input type="password" id="password" placeholder="Пароль" name="passwordInput" class="<?php echo $inputClass; ?>" onfocus="resetInput(this)" required>
    <button type="submit">Перевірити</button>
    <p id="checkResult"> <?php echo $message; ?> </p>
</form>
<p id="checkResult"> <?php echo $message; ?> </p>

<script>
function resetInput(input) {
    input.className = 'normal';
}
</script>
</body>
</html>