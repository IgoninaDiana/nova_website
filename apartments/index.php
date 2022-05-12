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
            <section class="apartment_section">
                <div class="wrapper">
                    <div class="apartment">
                        <div class="ap_status"><?php echo $apartment['status'] ?></div>
                        <img class="ap_photo" src="../img/apartments/<?php echo $apartment['photo'] ?>">
                        <div class="ap_info">
                            <h2 class="api_name"><?php echo $apartment['name'] ?></h2>
                            <p class="api_address"><?php echo $apartment['address']?></p>
                            <p class="api_description"><?php echo $apartment['description']?></p>
                            <p class="api_price"><?php echo number_format($apartment['price'], 0, ',', ' ') ?> ₽ <?php if ($apartment['status'] == 'Аренда') { echo '<span>/ мес.</span>'; } ?></p>
                            <div class="api_views">
                                <img class="apiv_img" src="../img/views.svg">
                                <p><?php echo $apartment['views'] ?></p>
                            </div>
                            <button class="api_button">Связаться</button>
                        </div>
                    </div>
                </div>
            </section>
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