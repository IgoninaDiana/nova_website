<?php
    require '../orm/db.php';
    if (isset($_GET['apartment'])) {
        $apartment = R::findOne('apartments', 'WHERE id = "'.$_GET['apartment'].'"');
        $apartment_views = R::load('apartments', $_GET['apartment']);
        $apartment_views->views = $apartment_views->views + 1;
        R::store($apartment_views);
    } else {
        $apartments = R::findAll('apartments', 'ORDER BY id DESC');
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>NOVA - Достоверная база данных о продаже и аренде жилой недвижимости</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.4/mobile-detect.min.js"></script>
        <script>
            let detect = new MobileDetect(window.navigator.userAgent);
            if (detect.mobile() == !null) {
                var get = '<?php if (isset($_GET["apartment"])) {echo "?apartment=".$_GET["apartment"];}; ?>';
                $(location).attr('href', '/m/apartments' + get);
            }
        </script>
    </head>
    <body>
        <header>
            <div class="wrapper">
                <div class="header">
                    <?php require '../menu.php'; ?>
                </div>
            </div>
        </header>
        <?php if (isset($_GET['apartment'])) : ?>
        <section class="apartment_modal" onclick="modal_windows_off()">
            <div class="a_info_modal">
                <p class="aim_user_name"><?php echo $apartment['user_name']?></p>
                <p class="aim_user_phone"><?php echo $apartment['user_phone']?></p>
            </div>
            <div class="a_text_modal">
                <p class="atem_p"><img class="atemp_img" src="../img/warning.png"><b>Это временный номер</b></p>
                <p>Он защищает исполнителя от нежелательных звонков. Не сохраняйте его: скоро телефон заменится на другой.</p>
            </div>
        </section>
            <section class="apartment_section">
                <div class="wrapper">
                    <div class="apartment">
                        <div class="ap_status"><?php echo $apartment['status'] ?></div>
                        <img class="ap_photo" src="../img/apartments/<?php echo $apartment['photo'] ?>">
                        <div class="ap_info">
                            <h2 class="api_name"><?php echo $apartment['name'] ?></h2>
                            <p class="api_address"><b><?php echo $apartment['address']?></b></p>
                            <p class="api_description"><?php echo $apartment['description']?></p>
                            <p class="api_price"><?php echo number_format($apartment['price'], 0, ',', ' ') ?> ₽ <?php if ($apartment['status'] == 'Аренда') { echo '<span>/ мес.</span>'; } ?></p>
                            <div class="api_users_info">
                                <img class="apiu_views" src="../img/views.svg">
                                <p><?php echo $apartment['views'] ?></p>
                                <img class="apiu_hearts" src="../img/hearts.svg">
                                <p>0</p>
                            </div>
                            <div class="api_buttons">
                                <button class="api_button" onclick="modal_windows_on()">Связаться</button>
                                <button class="api_like"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                function modal_windows_on() {
                    $('.apartment_modal').addClass('apartment_modal_on');
                }
                function modal_windows_off() {
                    $('.apartment_modal').removeClass('apartment_modal_on');
                }
            </script>
        <?php else : ?>

        <?php endif ?>
        <footer>
            <div class="wrapper">
                <div class="footer">
                    <div class="f_site">
                        <a href="/"><img class="fs_img" src="../img/logo_3.svg"></a>
                        <p class="fs_p">В базе NOVA.RU вы найдёте недвижимость в продаже и аренду. Все объявления проверены профессиональными модераторами. Для удобства вы можете загрузить мобильное приложение на iPhone и Android, а также легко находить объекты благодаря структурированному каталогу и наличию поиска на нашем сайте. Для облегчения поиска мы реализовали систему рекомендаций похожих объявлений.</p>
                    </div>
                    <div class="f_studio">
                        <img src="../img/logo_2.svg">
                        <p>© “NWS” - NIGHT WEB-STUDIO, 2021-<?php echo date("Y")?></br>© Герасимов Андрей Сергеевич</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>