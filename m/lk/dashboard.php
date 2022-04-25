<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php if (isset($_GET['id'])) : ?><?php echo $new->title ?><?php else : ?>Новости<?php endif ?></title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.4/mobile-detect.min.js"></script>
        <script>
            let detect = new MobileDetect(window.navigator.userAgent);
            if (detect.mobile() == null) {
                var get = '<?php if (isset($_GET["id"])) {echo "?id=".$_GET["id"];}; if (isset($_GET["rubrika"])) {echo "?rubrika=".$_GET["rubrika"];}; ?>';
                $(location).attr('href', '/news' + get);
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
        <section class="profile_section">
            <div class="wrapper">
                <div class="profile">
                    <div class="p_user">
                        <img class="pu_img" src="/img/users/<?php echo $_SESSION['user']->photo ?>">
                        <div class="pu_text">
                            <h4 class="put_h4"><?php echo $_SESSION['user']->surname ?> <?php echo $_SESSION['user']->name ?></h4>
                            <p class="put_p">Баланс: <?php echo $_SESSION['user']->balance ?>₽</p>
                        </div>
                    </div>
                    <a class="p_button" href="#">Редактировать информацию</a>
                    <div class="p_phone">
                        <p class="pp_p">Номер телефона</p>
                        <h4 class="pp_h4"><?php if ($_SESSION['user']->phone == "") : ?>Не указан<?php else : ?><?php echo $_SESSION['user']->phone ?><?php endif ?></h4>
                        <a class="pp_a" href="#">Сменить номер телефона</a>
                    </div>
                    <div class="p_email">
                        <p class="pe_p">Электронная почта</p>
                        <h4 class="pe_h4"><?php echo $_SESSION['user']->email ?></h4>
                        <a class="pe_a" href="#">Сменить электронную почту</a>
                    </div>
                    <a class="p_button" href="#">Сменить пароль</a>
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
            function menu_on() {
                    $('.menu_section').fadeIn(300).removeClass('menu_off');
            }

            function menu_off() {
                    $('.menu_section').fadeOut(300).addClass('menu_off');
            }
        </script>
    </body>
</html>