<?php 

function dd(mixed $value) : void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

function s(string $data) : string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

function validate(string $value, int $min = 1, int $max = INF): bool
{
    if ( is_string($value) ) {
        $value = trim($value);
        $length = strlen($value);
        return $length >= $min && $length <= $max;
    }
    return false;
}

function redirec(string $path) : void 
{
    header("Location: {$path}");
}

function connection() : PDO
{
    $dns = "mysql:host=localhost;dbname=yourdatabase;charset=utf8";
    $user = "root";
    $pass = "";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    try {
        $conn = new PDO($dns, $user, $pass, $options);
    } catch (PDOException $e) {
        echo "Error connection faild: " . $e->getMessage();
        die;
    }
    
    return $conn;
}