<?php
    if ($_GET['query'] == "newbuilding_recommendations") {
        $response = file_get_contents('https://api.cian.ru/newbuilding-search/v1/get-newbuilding-recommendations/?regionId=4602&size=3&pageType=desktop');
        $json = '{"status": "ok", "response": '.$response.'}';
        echo $json;
    }