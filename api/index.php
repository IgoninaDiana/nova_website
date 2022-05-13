<?php
    require '../orm/db.php';

    if ($_GET['query'] == 'newbuilding_recommendations') {
        $response = file_get_contents('https://api.cian.ru/newbuilding-search/v1/get-newbuilding-recommendations/?regionId=4602&size=3&pageType=desktop');
        $json = '{"status": "ok", "response": '.$response.'}';
        echo $json;
    }

    if ($_GET['query'] == 'news') {
        if ($_GET['limit'] > 0) {
            $news = R::findAll('news', 'ORDER BY id DESC LIMIT '.$_GET['limit']);
            $new_arr = array();
            foreach ($news as $new) {
                array_push($new_arr, ['id'=>$new['id'], 'rubrika'=>$new['rubrika'], 'title'=>$new['title'], 'text'=>$new['text'], 'photo'=>$new['photo'], 'autor'=>$new['autor'], 'date'=>$new['date'], 'views'=>$new['views']]);
            }
            $arr = ['status'=>'ok', 'news'=>$new_arr];
            $json = json_encode($arr);
            echo $json;
        } else {
            $news = R::findAll('news', 'ORDER BY id DESC');
            $new_arr = array();
            foreach ($news as $new) {
                array_push($new_arr, ['id'=>$new['id'], 'rubrika'=>$new['rubrika'], 'title'=>$new['title'], 'text'=>$new['text'], 'photo'=>$new['photo'], 'autor'=>$new['autor'], 'date'=>$new['date'], 'views'=>$new['views']]);
            }
            $arr = ['status'=>'ok', 'news'=>$new_arr];
            $json = json_encode($arr);
            echo $json;
        }
    }

    if ($_GET['query'] == 'email') {
        $user = R::findOne('users', 'WHERE `email` = "'.$_GET['email'].'"');
        if ($user) {
            $arr = ['status'=>'ok', 'email'=>true];
            $json = json_encode($arr);
            echo $json;
        } else {
            $arr = ['status'=>'ok', 'email'=>false];
            $json = json_encode($arr);
            echo $json;
        }
    }

    if ($_POST['auch'] == 'reg') {
        $user = R::dispense('users');
        $user->name = $_POST['name'];
        $user->surname = $_POST['surname'];
        $user->position = 1;
        $user->photo = '';
        $user->phone = '';
        $user->email = $_POST['email'];
        $user->password = md5($_POST['pass']);
        R::store($user);
        $arr = ['status'=>'successful'];
        $json = json_encode($arr);
        echo $json;
    }

    if ($_POST['auch'] == 'log') {
        $user = R::findOne('users', 'WHERE `email` = "'.$_POST['login'].'" OR `phone` = "'.$_POST['login'].'"');
        if ($user) {
            if (md5($_POST['pass']) == $user->password) {
                $_SESSION['user'] = $user;
                $arr = ['status'=>'successful'];
                $json = json_encode($arr);
                echo $json;
            } else {
                $arr = ['status'=>'error', 'message'=>'Неверно введен пароль!'];
                $json = json_encode($arr);
                echo $json;
            }
        } else {
            $arr = ['status'=>'error', 'message'=>'Пользователь не найден!'];
            $json = json_encode($arr);
            echo $json;
        }
    }

    if ($_GET['auch'] == 'out') {
        unset($_SESSION['user']);
        $arr = ['status'=>'successful'];
        $json = json_encode($arr);
        echo $json;
    }

    if ($_GET['query'] == 'apartments') {
        if ($_GET['limit'] > 0) {
            $apartments = R::findAll('apartments', 'ORDER BY id DESC LIMIT '.$_GET['limit']);
            $apartments_arr = array();
            foreach ($apartments as $apartment) {
                array_push($apartments_arr, ['id'=>$apartment['id'], 'photo'=>$apartment['photo'], 'status'=>$apartment['status'], 'name'=>$apartment['name'], 'price'=>$apartment['price'], 'address'=>$apartment['address']]);
            }
            $arr = ['status'=>'ok', 'apartments'=>$apartments_arr];
            $json = json_encode($arr);
            echo $json;
        } else {
            if ($_GET['budget_ot'] == '') {
                $_GET['budget_ot'] = 0;
            }
            if ($_GET['budget_do'] == '') {
                $_GET['budget_do'] = 999999999999999999999999999;
            }

            if ($_GET['search'] == '') {
                $apartments = R::findAll('apartments', 'WHERE price BETWEEN '.$_GET["budget_ot"].' AND '.$_GET["budget_do"].' ORDER BY id DESC');
                $apartments_arr = array();
                foreach ($apartments as $apartment) {
                    array_push($apartments_arr, ['id'=>$apartment['id'], 'photo'=>$apartment['photo'], 'status'=>$apartment['status'], 'name'=>$apartment['name'], 'price'=>$apartment['price'], 'address'=>$apartment['address']]);
                }
                $arr = ['status'=>'ok', 'apartments'=>$apartments_arr];
                $json = json_encode($arr);
                echo $json;
            } else {
                $apartments = R::findAll('apartments', 'WHERE name LIKE "%'.$_GET['search'].'%" AND price BETWEEN '.$_GET["budget_ot"].' AND '.$_GET["budget_do"].' ORDER BY id DESC');
                $apartments_arr = array();
                foreach ($apartments as $apartment) {
                    array_push($apartments_arr, ['id'=>$apartment['id'], 'photo'=>$apartment['photo'], 'status'=>$apartment['status'], 'name'=>$apartment['name'], 'price'=>$apartment['price'], 'address'=>$apartment['address']]);
                }
                $arr = ['status'=>'ok', 'apartments'=>$apartments_arr];
                $json = json_encode($arr);
                echo $json;
            }
        }
    }