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