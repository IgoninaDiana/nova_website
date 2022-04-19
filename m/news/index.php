<?
    require '../../orm/db.php';
    if (isset($_GET['id'])) {
        $new = R::findOne('news', 'WHERE id = "'.$_GET['id'].'"');
        $new_views = R::load('news', $_GET['id']);
        $new_views->views = $new->views + 1;
        R::store($new_views);
    } else {
        $news = R::findAll('news');
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title></title>
        <link rel="stylesheet" href="../css/style.css">
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
                <?php require '../menu.php'; ?>
            </div>
        </section>
        <header>
            <div class="wrapper">
                <div class="header">
                    <a href="/"><img src="../../img/logo_1.svg"></a>
                    <img onclick="menu_on()" class="h_menu" src="../../img/menu.svg">
                </div>
            </div>
        </header>
        <?php if (isset($_GET['id'])) : ?>
            <section class="new_section">
                <div class="wrapper">
                    <div class="new">
                        <div class="n_crumbs">
                            <a class="nc_a" href="/m/news">Новости</a>
                            <p class="nc_p">/</p>
                            <a class="nc_a" href="/m/news?rubrika=<?php echo $new->rubrika ?>"><?php echo $new->rubrika ?></a>
                        </div>
                        <h3 class="n_h3"><?php echo $new->title ?></h3>
                        <div class="n_new_info">
                            <p class="nn_p"><?php echo $new->date ?></p>
                            <p class="nn_p"><img class="nnp_img" src="../../img/views.svg"><?php echo $new->views ?></p>
                        </div>
                        <img class="n_img" src="../../img/news/<?php echo $new->photo ?>">
                        <p class="n_text"><?php echo $new->text ?></p>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <!-- <section class="news_section">
                <div class="wrapper">
                    <div class="news">
                        <div class="ns_items">
                            <?php foreach ($news as $new) : ?>
                                <div class="n_item">

                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </section> -->
        <?php endif ?>
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
            function menu_on() {
                    $('.menu_section').fadeIn(300).removeClass('menu_off');
            }

            function menu_off() {
                    $('.menu_section').fadeOut(300).addClass('menu_off');
            }
        </script>
    </body>
</html>