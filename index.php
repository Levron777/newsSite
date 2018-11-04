<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style/mainStyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="database/wow.min.js"></script>
  <script>
    new WOW().init();
  </script>
  <title>Stocks market</title>
</head>
<body>

  <!-- Обертка сайта -->

  <div class="wrapper grid" id="home">

    <!-- Шапка сайта -->

    <header class="header grid">
        
      <!-- Навигационный блок -->

      <nav>
        <a class="navLink" href="#">Лого сайта</a>
        <a class="navLink" href="#">Новости</a>
        <a class="navLink" href="#">Бизнес</a>
        <a class="navLink" href="#">Технологии</a>
        <a class="navLink" href="#">Карьера</a>
        <form class="searchForm" action="#">
          <input class="search" type="text" placeholder="&#128269 ПОИСК" name="search">
        </form>
        <div class="logIn">
          <a href="#"><img src="images/lock.png" alt="">Вход</a>
        </div>
      </nav>
    </header>

    <!-- Блок с основным контентом -->

      <!-- Правая колонка с кратким содержанием и баннером -->

      <?php 
        require_once "database/db.php";
      ?>

      <aside class="aside grid">
        <h4 class="asideTitle">Новости</h4>

        <?php
          // выведем в самом начале 5 статей
          require_once "database/db.php";
           
          $articles = $pdo->prepare("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 8");
          $articles->execute();
          $allArticles = $articles->fetchAll();
    
          foreach($allArticles as $oneNews): 
        ?>
        <a class="asideItem grid" href="pages/oneArticle.php?id=<?php echo $oneNews['id'];?>">
          <h4><?=$oneNews['title'];?></h4>
          <p><?=$oneNews['smallText'];?></p>
        </a>
        <?php endforeach; ?>

      <!-- Блок с кнопкой Показать еще -->

        <div class="asideItem wow bounceInRight slow grid">
          <div class="asideItemButton">
            <input class="asideItemButton" id="showMoreAside" countShow="8" countAdd="3" type="button" value="Показать еще" />
          </div>
        </div>
      </aside>

      <!-- Главная новостная статья большего размера -->

      <a class="articleMain grid" href="pages/oneArticle.php?id=1">
        <img src="images/articles/1.jpg" alt="">
        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta, nisi eget laoreet pharetra, magna.</h4>
      </a>

      <!-- Список всех статей по убыванию -->

      <div class="articlesList grid">

        <?php

          $articlesMain = $pdo->prepare("SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 8");
          $articlesMain->execute();
          $allArticlesMain = $articlesMain->fetchAll();

          foreach($allArticlesMain as $oneNewsMain): 
        ?>
        <a class="articleListItem grid" href="pages/oneArticle.php?id=<?php echo $oneNewsMain['id'];?>">
          <img src="images/articles/<?=$oneNewsMain['id'];?>.jpg" alt="">
          <div><?=$oneNewsMain['smallText'];?></div>
        </a>
        <?php endforeach; ?>
        
      </div>

      <!-- Блок для загрузки дополнительного контента -->

      <div class="loadMore wow bounceInLeft slow grid">
        <div class="loadMoreItem grid">
          <input class="loadMoreItemButton" id="showMoreMain" countShowMain="8" countAddMain="3" type="button" value="Показать еще" />
        </div>
      </div>

      <div class="scroll-up">
		    <a href="#home"><img src="images/Arrow_up.png" alt=""></a>
      </div>

      <!-- Нижнее меню сайта -->
  
      <footer class="footer grid">
        <nav>
          <a class="navLink" href="#">О компании</a>
          <a href="#">Реклама</a>
          <a href="#">Сервисы</a>
          <a href="#">Подписка</a>
          <a href="#">Написать в редакцию</a>
          <a href="#">Подписка</a>
        </nav>
      </footer>
  </div>
  <script src="javaScript/script.js"></script>
</body>
</html>