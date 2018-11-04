$(document).ready(function() {
         
  $('#showMoreAside').click(function() {
    var btnMore = $(this);
    var countShow = parseInt($(this).attr('countShow'));
    var countAdd  = $(this).attr('countAdd');
    btnMore.val('Подождите...');
       
    $.ajax({
      url: "../database/ajax.php", // куда отправляем
      type: "post", // метод передачи
      dataType: "json", // тип передачи данных
      data: { // что отправляем
        "countShow": countShow,
        "countAdd": countAdd
      },

      // после получения ответа сервера

      success: function(data) {
        if (data.result == "success") {
          $('.asideItem:nth-last-child(2)').after(data.html);
          btnMore.val('Показать еще');
          btnMore.attr('countShow', (countShow + 3));
        }else {
          $('.asideItemButton').hide(600);
        }
      }
    });
  }); 

  $('#showMoreMain').click(function() {
    var btnMoreMain = $(this);
    var countShowMain = parseInt($(this).attr('countShowMain'));
    var countAddMain  = $(this).attr('countAddMain');
    btnMoreMain.val('Подождите...');
       
    $.ajax({
      url: "../database/ajaxMain.php", // куда отправляем
      type: "post", // метод передачи
      dataType: "json", // тип передачи данных
      data: { // что отправляем
        "countShowMain": countShowMain,
        "countAddMain": countAddMain
      },

      // после получения ответа сервера
      
      success: function(data) {
        if (data.result == "success") {
          $('.articleListItem:nth-last-child(2)').after(data.html);
          btnMoreMain.val('Показать еще');
          btnMoreMain.attr('countShowMain', (countShowMain + 3));
        }else {
          $('.loadMore').hide(600);
        }
      }
    });
  });

  // Анимация прокрутки в начало

  $(window).scroll(function() {
    if ($(this).scrollTop() > 200) {
      $('.scroll-up').fadeIn(1000);
    } else {
      $('.scroll-up').fadeOut(1000);
    }
  });

  // Плавная анимация прокрутки 

  $(function(){
    $('a[href^="#"]').on('click', function(event) {
      event.preventDefault();
      var sc = $(this).attr("href");
      var dn = $(sc).offset().top;
      $('html, body').animate({scrollTop: dn}, 1000);
    });
  });

}); 