<?php
    require '../../orm/db.php';

    // Обработка отображения страниц
    if (isset($_SESSION['user'])) {
        switch ($_GET['page']) {
            // case 'reviews': include 'content.php';
            // break;
            default: include 'dashboard.php';
        }
    } else {
        include 'login.php';
    }