<?php
    require '../orm/db.php';
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>NOVA - Достоверная база данных о продаже и аренде жилой недвижимости</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.4/mobile-detect.min.js"></script>
        <script>
            let detect = new MobileDetect(window.navigator.userAgent);
            if (detect.mobile() == null) {
                $(location).attr('href', '/');
            }
        </script>
    </head>
    <body>
        <section class="menu_section menu_off">
            <div class="menu">
                <?php require 'menu.php'; ?>
            </div>
        </section>
        <section class="button_section">
            <div class="button_w wrapper">
                <a class="button button_on" href="#">Разместить объявление</a>
            </div>
        </section>
        <header>
            <div class="wrapper">
                <div class="header">
                    <a href="/"><img src="../img/logo_1.svg"></a>
                    <img onclick="menu_on()" class="h_menu" src="../img/menu.svg">
                </div>
            </div>
        </header>
        <section class="search_button_section">
            <div class="wrapper">
                <div class="search_button">
                    <h3>Поиск недвижимости</h3>
                    <div class="sb_items">
                        <a class="sb_item" href="#">
                            <img class="sbi_img" src="../img/key.svg">
                            <h4 class="sbi_h4">Квартиры</h4>
                        </a>
                        <a class="sb_item" href="#">
                            <img class="sbi_img" src="../img/krovate.svg">
                            <h4 class="sbi_h4">Комнаты</h4>
                        </a>
                        <a class="sb_item" href="#">
                            <img class="sbi_img" src="../img/dome.svg">
                            <h4 class="sbi_h4">Коммерческая недвижимость</h4>
                        </a>
                        <a class="sb_item" href="#">
                            <img class="sbi_img" src="../img/home.svg">
                            <h4 class="sbi_h4">Гаражи</h4>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="recommendations_section">
            <div class="wrapper">
                <div class="recommendations">
                    <h3>Рекомендованные ЖК</h3>
                    <div class="r_items">
                        <span>Загрузка ...</span>
                        <!-- AJAX ответ -->
                    </div>
                </div>
            </div>
        </section>
        <section class="news_section">
            <div class="wrapper">
                <div class="news">
                    <h3>Новости</h3>
                    <div class="n_items">
                        <span>Загрузка ...</span>
                        <!-- AJAX ответ -->
                    </div>
                </div>
            </div>
        </section>
        <section class="info_site_section">
            <div class="wrapper">
                <div class="info_site">
                    <h3 class="is_h3">За недвижимостью — на NOVA.RU</h3>
                    <p class="is_p">В базе NOVA.RU вы найдёте недвижимость в продаже и аренду. Все объявления проверены профессиональными модераторами. Для удобства вы можете загрузить мобильное приложение на iPhone и Android, а также легко находить объекты благодаря структурированному каталогу и наличию поиска на нашем сайте. Для облегчения поиска мы реализовали систему рекомендаций похожих объявлений.</p>
                    <p>Сайт сделан на базе API <a class="is_a" href="cian.ru" target="_blank">cian.ru</a></p>
                </div>
            </div>
        </section>
        <footer>
            <div class="wrapper">
                <div class="footer">
                    <p>© “NWS” - NIGHT WEB-STUDIO, 2021-<?php echo date("Y") ?></p>
                </div>
            </div>
        </footer>
        <script>
            $.ajax({
                url: '/api/',
                method: 'get',
                dataType: 'json',
                data: {query: 'newbuilding_recommendations'},
                success: function(data) {
                    $('.r_items').empty();
                    let i = 0;
                    while (i < data['response']['newbuildings'].length) {
                        $('.r_items').append('<div class="r_item"><div class="ri_text"><h3 class="rit_h3">' + data['response']['newbuildings'][i]['name'] + '</h3><p class="rit_price">' + data['response']['newbuildings'][i]['priceDisplay'] + '</p><p class="rit_address">' + data['response']['newbuildings'][i]['fullAddress'] + '</p></div><img class="ri_img" src="' + data['response']['newbuildings'][i]['image']['fullUrl'] + '"></div>');
                        i++;
                    }
                }
            });

            $.ajax({
                url: '/api/',
                method: 'get',
                dataType: 'json',
                data: {query: 'news', limit: 5},
                success: function(data) {
                    $('.n_items').empty();
                    let i = 0;
                    while (i < data['news'].length) {
                        $('.n_items').append('<a class="n_item" href="/m/news?id=' + data['news'][i]['id'] + '"><div class="ni_info"><p class="ni_p">' + data['news'][i]['date'] + '</p><div class="ni_views"><img class="niv_img" src="../img/views.svg"><p>' + data['news'][i]['views'] + '</p></div></div><h4 class="ni_h4">' + data['news'][i]['title'] + '</h4></a>');
                        i++;
                    }
                }
            });

            var scrollPos = 0;
            $(window).scroll(function() {
                var st = $(this).scrollTop();
                if (st < scrollPos) {
                    $('.button_w').fadeIn(300, function() {
                        $('.button').removeClass('button_off');
                        $('.button').addClass('button_on');
                    });
                } else {
                    $('.button_w').fadeOut(300, function() {
                        $('.button').removeClass('button_off');
                        $('.button').addClass('button_on');
                    });
                }
                scrollPos = st;
            });

            function menu_on() {
                    $('.menu_section').fadeIn(300).removeClass('menu_off');
            }

            function menu_off() {
                    $('.menu_section').fadeOut(300).addClass('menu_off');
            }
        </script>
    </body>
</html>