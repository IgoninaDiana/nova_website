<!DOCTYPE html>
<html class="auch_html" lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Авторизация</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.4/mobile-detect.min.js"></script>
        <script>
            let detect = new MobileDetect(window.navigator.userAgent);
            if (detect.mobile() == null) {
                $(location).attr('href', '/lk');
            }
        </script>
    </head>
    <body class="auch_body">
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
        <?php if (!isset($_GET['reg'])) : ?>
            <section class="log_section">
                <div class="log">
                    <h2 class="l_h2">Авторизация</h2>
                    <input class="l_i" id="login" type="text" placeholder="Телефон или E-mail">
                    <input class="l_i" id="pass" type="password" placeholder="Пароль">
                    <button onclick="ajax_log()" class="l_b">Войти</button>
                    <a class="l_a" href="/m/lk?reg">Зарегистрироваться</a>
                </div>
            </section>
             <script>
                function ajax_log() {
                    var error = '';
                    var login = document.querySelector('#login').value;
                    var password = document.querySelector('#pass').value;
                    
                    if (password == '') {
                        error = 'Введите пароль!';
                    }
                    if (login == '') {
                        error = 'Введите логин!';
                    }

                    if (error == '') {
                        $.ajax({
                            url: '/api/',
                            method: 'post',
                            dataType: 'json',
                            data: {auch: 'log', login: document.querySelector('#login').value, pass: document.querySelector('#pass').value},
                            success: function(data) {
                                if (data['status'] == 'error') {
                                    alert(data['message']);
                                }
                                if (data['status'] == 'successful') {
                                    $(location).attr('href', '/m/lk')
                                }
                            }
                        });
                    } else {
                        alert(error);
                    }
                }
            </script>
        <?php else : ?>
            <section class="reg_section">
                <div class="reg">
                    <h2 class="r_h2">Регистрация</h2>
                    <input class="r_i" id="name" type="text" placeholder="Имя">
                    <input class="r_i" id="surname" type="text" placeholder="Фамилия">
                    <input class="r_i" id="email" type="text" placeholder="E-mail">
                    <input class="r_i" id="pass" type="password" placeholder="Пароль">
                    <input class="r_i" id="pass_two" type="password" placeholder="Повтор пароля">
                    <button onclick="ajax_reg()" class="r_b">Зарегистрироваться</button>
                    <a class="r_a" href="/m/lk">Войти</a>
                </div>
            </section>
            <script>
                function ajax_reg() {
                    var error = '';
                    var name = document.querySelector('#name').value;
                    var surname = document.querySelector('#surname').value;
                    var email = document.querySelector('#email').value;
                    var password = document.querySelector('#pass').value;
                    var password_two = document.querySelector('#pass_two').value;
                    
                    
                    if (password_two == '') {
                        error = 'Введите повторный пароль!';
                    }
                    if (password == '') {
                        error = 'Введите пароль!';
                    }
                    if (email == '') {
                        error = 'Введите email!';
                    }
                    if (surname == '') {
                        error = 'Введите фамилию!';
                    }
                    if (name == '') {
                        error = 'Введите имя!';
                    }
                    if (password_two != password) {
                        error = 'Пароли не совпадают!';
                    }

                    if (error == '') {
                        $.ajax({
                            url: '/api/',
                            method: 'get',
                            dataType: 'json',
                            data: {query: 'email', email: email},
                            success: function(data) {
                                if (data['email'] == false) {
                                    $.ajax({
                                        url: '/api/',
                                        method: 'post',
                                        dataType: 'json',
                                        data: {auch: 'reg', name: document.querySelector('#name').value, surname: document.querySelector('#surname').value, email: document.querySelector('#email').value, pass: document.querySelector('#pass_two').value},
                                        success: function(data) {
                                            $(location).attr('href', '/m/lk')
                                        }
                                    });
                                } else {
                                    alert('Пользователь уже существует!');
                                }
                            }
                        });
                    } else {
                        alert(error);
                    }
                }
            </script>
        <?php endif ?>
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