<?php
$q = $_POST['q'];
$dsn = "mysql:host=127.0.0.1;charset=utf8;";
$pdo = new PDO($dsn,'root','123');
$pdo->query("CREATE DATABASE IF NOT EXISTS `loftschoolsecurity`");
$pdo->query('use loftschoolsecurity;');
$pdo->query("CREATE TABLE IF NOT EXISTS `xss` (
  `text` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Пример XSS</title>
</head>
<body>

<h1>Значение в базе:</h1>
<?php
$query=$pdo->query('select * from xss;');
$result=$query->fetch();
echo $result['text'];
?>
<form action="" method="post">
    <input type="text" name="q" placeholder="Начните поиск">
    <input type="submit" value="Найти">
<!--    <img src="/mime/image.png" alt="" onload="alert()">-->
</form>
</body>
</html>

<?php if(!empty($q)) {
    $q = clearAll($q);
    //Всегда очищаем
    $pdo->query("truncate table xss;"); // <script>alert('xss');</script>
    $pdo->query("insert into xss (text) VALUES (\"{$q}\");");
}

function clearAll($data)
{   //<img src="$img">
    $data = strip_tags($data); //http://remote-server/1.php onload=alert()
    $data = htmlspecialchars($data, ENT_QUOTES);
    return $data;
}
echo htmlentities("<img src=''/>");

?>