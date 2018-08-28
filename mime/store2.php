<?php
$file = $_FILES['file'];
require("vendor/autoload.php"); //Подключаем composer
$allowed = [
    'jpg',
    'jpeg',
    'png',
    'gif'
];
$filetype = explode('.', $file['name']);
if (in_array($filetype[count($filetype)-1], $allowed)) {
    echo ' allowed';
} else {
    echo "ALLOWED NOT FOUND";
}
use Intervention\Image\ImageManagerStatic;

if(preg_match('/jpg/',$file['name']) or preg_match('/png/',$file['name']) or preg_match('/gif/',$file['name']))
{ //Проверяем имя файла. У нас PNG - файл проходит
    if(preg_match('/jpg/',$file['type']) or preg_match('/png/',$file['type']) or preg_match('/gif/',$file['type']))
        {
            //Проверяем mime type - у нас GIF. Все Ок
            echo 'Файл имеет верный mime-type. "Доверяем" и загружаем его'.PHP_EOL;
            $img = ImageManagerStatic::make($file['tmp_name']); //Открываем
            $img->resize(100, 100); //Изменяем размер
            $img->save('uploads/NEW'.$file['name']); //Сохраняем с новым именем

            echo "Выводим результат проверки: file-type: ".mime_content_type('uploads/'.$file['name']).PHP_EOL;
        }
}
else {
    die("Ошибка итд");
}
echo "<a href='index.html'>Назад</a>";