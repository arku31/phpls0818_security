<?php
$file = $_FILES['file'];
print_r($file);
$allowedTypes = ['image/png', 'image/jpeg'];
$allowedExtension = ['jpg', 'png', 'gif'];
$exploded = explode('.', $file['name']);
$extension = $exploded[count($exploded)-1];

if (in_array($file['type'], $allowedTypes) && in_array($extension, $allowedExtension)) {
    //Проверяем mime type - у нас GIF. Все Ок
    echo 'Файл имеет верный mime-type. "Доверяем" и загружаем его' . PHP_EOL;
    move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
    echo "Выводим результат проверки: file-type: " . mime_content_type('uploads/' . $file['name']) . PHP_EOL;
} else {
    die("Ошибка итд");
}
echo "<a href='index.html'>Назад</a>";
//php.jpg