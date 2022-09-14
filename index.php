<?php
    require 'orm/db.php';
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
            if (detect.mobile() != null) {
                $(location).attr('href', '/m');
            }
        </script>
    </head>
    <body>
        <header>
            <div class="wrapper">
                <div class="header">
                    <?php require 'menu.php'; ?>
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
                            <a class="wtb_a" href="#">Разместить объявление</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="search_section">
            <div class="wrapper">
                <div class="search">
                    <div class="s_blok">
                        <h3 class="sb_h3">Тип недвижимости</h3>
                        <select class="sb_select" id="">
                            <option selected value="">Любая</option>
                            <option value="">Квартиры</option>
                            <option value="">Комнаты</option>
                            <option value="">Гаражи</option>
                            <option value="">Коммерческая недвижимость</option>
                        </select>
                    </div>
                    <div class="s_blok s_blok_search">
                        <h3 class="sb_h3">Поиск по объявлениям</h3>
                        <input class="sb_input" type="text" placeholder="Введите текст для поиска">
                    </div>
                    <div class="s_blok">
                        <h3 class="sb_h3">Бюджет поиска</h3>
                        <div class="sb_price">
                            <input class="sbp_input" type="number" placeholder="От 0 ₽">
                            <p class="cbp_p">-</p>
                            <input class="sbp_input" type="number" placeholder="До 40 000 000 ₽">
                        </div>
                    </div>
                    <div class="s_blok">
                        <button class="sb_button">Найти</button>
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
        <section class="apartments_section">
            <div class="wrapper">
                <div class="apartments">
                    <h2>Рекомендованные объявления</h2>
                    <div class="apa_items">
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
                    </div>
                    <div class="f_studio">
                        <img class="f_img" src="img/logo_2.svg">
                        <p>© “NWS” - NIGHT WEB-STUDIO, 2021-<?php echo date("Y")?></br>© Герасимов Андрей Сергеевич</p>
                    </div>
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
                    for (i in data['response']['newbuildings']) {
                        $('.r_items').append('<div class="r_item"><div class="ri_text"><h3 class="rit_h3">' + data['response']['newbuildings'][i]['name'] + '</h3><p class="rit_price">' + data['response']['newbuildings'][i]['priceDisplay'] + '</p><p class="rit_address">' + data['response']['newbuildings'][i]['fullAddress'] + '</p></div><img class="ri_img" src="' + data['response']['newbuildings'][i]['image']['fullUrl'] + '"></div>');
                    }
                }
            });

            $.ajax({
                url: '/api/',
                method: 'get',
                dataType: 'json',
                data: {query: 'apartments', limit: 4},
                success: function(data) {
                    $('.apa_items').empty();
                    let i = 0;
                    for (i in data['apartments']) {
                        $('.apa_items').append('<a class="apa_item" href="/apartments?apartment=' + data['apartments'][i]['id'] + '"><div class="apai_info"><img class="apai_info_img" src="/img/apartments/' + data['apartments'][i]['photo'] + '"><div class="apai_info_text"><p class="apai_status">' + data['apartments'][i]['status'] + '</p><h3 class="apai_name">' + data['apartments'][i]['name'] + '</h3></div></div><div class="apai_text"><p class="apai_price">' + data['apartments'][i]['price'].toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ") + ' ₽ <span class="apai_span" id="apai_span_' + data['apartments'][i]['id'] + '"></span></p><p class="apai_address">' + data['apartments'][i]['address'] + '</p></div></a>');
                        if (data['apartments'][i]['status'] == 'Аренда') {
                            $('#apai_span_' + data['apartments'][i]['id']).append('/ мес.');
                        }
                    }
                }
            });
        </script>
    </body>
</html>
