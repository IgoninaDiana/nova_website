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
            if (detect.mobile() != null) {
                $(location).attr('href', '/m');
            }
        </script>
    </head>
    <body>
        <header>
            <div class="wrapper">
                <div class="header">
                    <div class="h_site">
                        <a href="/"><img class="hs_img" src="/img/logo_1.svg"></a>
                        <nav class="hs_nav">
                            <a class="hsn_a" href="#">Новости</a>
                            <a class="hsn_a" href="#">API</a>
                        </nav>
                    </div>
                    <div class="hs_nav">
                        <a class="hsn_a_reg" href="#">Зарегистрироваться</a>
                        <a class="hsn_a_log" href="#">Войти</a>
                    </div>
                </div>
            </div>
        </header>
        <section class="welcome_section">
            <img class="welcome_img" src="img/w_1.png">
            <div class="wrapper">
                <div class="welcome">
                    <div class="w_text">
                        <h1 class="wt_h1">NOVA.RU — это ...</h1>
                        <p class="wt_p">Достоверная база данных о продаже</br>и аренде жилой недвижимости</p>
                        <div class="wt_button">
                            <a class="wtb_a" href="#">Перейти к поиску</a>
                            <a class="wtb_a" href="#">Разместить объявление</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="recommendations_section">
            <div class="wrapper">
                <div class="recommendations">
                    <h2>Рекомендованные ЖК</h2>
                    <div class="r_items">
                        <!-- AJAX ответ -->
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class="wrapper">
                <div class="footer">
                    <div class="f_site">
                        <a href="/"><img class="fs_img" src="img/logo_3.svg"></a>
                        <p class="fs_p">В базе NOVA.RU вы найдёте недвижимость в продаже и аренду. Все объявления проверены профессиональными модераторами. Для удобства вы можете загрузить мобильное приложение на iPhone и Android, а также легко находить объекты благодаря структурированному каталогу и наличию поиска на нашем сайте. Для облегчения поиска мы реализовали систему рекомендаций похожих объявлений.</p>
                        <p>Сайт сделан на базе API <a class="fsp_a" href="cian.ru" target="_blank">cian.ru</a></p>
                    </div>
                    <div class="f_studio">
                        <img src="img/logo_2.svg">
                        <p>© “NWS” - NIGHT WEB-STUDIO, 2021-<?php echo date("Y")?></br>© Герасимов Андрей Сергеевич</p>
                    </div>
                </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
        </script>
    </body>
</html>