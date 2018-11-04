<?php
// Загрузка доп контента основного блока

require_once "db.php"; // подключение к базе данных

$countViewMain = (int)$_POST['countAddMain'];  // количество записей, получаемых за один раз
$startIndexMain = (int)$_POST['countShowMain']; // с какой записи начать выборку
 
// запрос к бд
$articlesMain = $pdo->prepare("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT ?, ?");
$articlesMain->bindValue(1, $startIndexMain, PDO::PARAM_INT);
$articlesMain->bindValue(2, $countViewMain, PDO::PARAM_INT);
$articlesMain->execute();
$allArticlesMain = $articlesMain->fetchAll();
 
if (empty($allArticlesMain)) {
  // если новостей нет
  echo json_encode(array(
    'result'    => 'finish'
  ));
} else {
  // если новости получили из базы, то сформируем html элементы
  // и отдадим их клиенту
  $html = "";
  foreach ($allArticlesMain as $oneArticleMain) {
    $html .= "
      <a class='articleListItem grid wow bounceInUp slow' href='../pages/oneArticle.php?id={$oneArticleMain['id']}'>
        <img src='images/articles/{$oneArticleMain['id']}.jpg' alt=''>
        <div>{$oneArticleMain['smallText']}</div>
      </a>
    ";
  }
  echo json_encode(array(
    'result'    => 'success',
    'html'      => $html
  ));
};
?>