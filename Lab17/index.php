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
        }
        label, input, button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        .normal { color: black; }
        .waiting { color: orange; font-weight: bold; }
        .valid { color: blue; font-weight: bold; }
        .invalid { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <form id="passwordForm" method="post" action="">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Submit</button>
    </form>
    <p id="response" class="normal">Type a password and submit</p>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'] ?? '';
        $pattern = "/^.{6,}$/";
        if (!empty($password) && preg_match($pattern, $password)) {
            echo "<script>
                    document.getElementById('response').textContent = 'Password is valid';
                    document.getElementById('response').className = 'valid';
                  </script>";
        } else {
            echo "<script>
                    document.getElementById('response').textContent = 'Password is invalid';
                    document.getElementById('response').className = 'invalid';
                  </script>";
        }
        echo "<script>
                document.getElementById('password').disabled = false;
              </script>";
    }
    ?>

    <script>
        document.getElementById('passwordForm').addEventListener('submit', function() {
            document.getElementById('password').disabled = true;
            document.getElementById('response').textContent = 'Waiting for server response...';
            document.getElementById('response').className = 'waiting';
        });

        document.getElementById('password').addEventListener('input', function() {
            document.getElementById('response').textContent = 'Type a password and submit';
            document.getElementById('response').className = 'normal';
        });
    </script>
</body>
</html>
