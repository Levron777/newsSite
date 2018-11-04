<?php

// Загрузка доп контента правой колонки

require_once "db.php"; // подключение к базе данных
 
$countView = (int)$_POST['countAdd'];  // количество записей, получаемых за один раз
$startIndex = (int)$_POST['countShow']; // с какой записи начать выборку
 
// запрос к бд
$articles = $pdo->prepare("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT ?, ?");
$articles->bindValue(1, $startIndex, PDO::PARAM_INT);
$articles->bindValue(2, $countView, PDO::PARAM_INT);
$articles->execute();
$allArticles = $articles->fetchAll();
 
if (empty($allArticles)) {
  // если новостей нет
  echo json_encode(array(
    'result'    => 'finish'
  ));
} else {
  // если новости получили из базы, то сформируем html элементы
  // и отдадим их клиенту
  $html = "";
  foreach ($allArticles as $oneArticle) {
    $html .= "
      <a class='asideItem grid wow bounceInUp slow' href='../pages/oneArticle.php?id={$oneArticle['id']}'>
        <h4>{$oneArticle['title']}</h4>
        <p>{$oneArticle['smallText']}</p>
      </a>
    ";
  }
  echo json_encode(array(
    'result'    => 'success',
    'html'      => $html
  ));
};
?>