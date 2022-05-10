<?php
    require 'rb.php';
    R::setup('mysql:host=localhost;dbname=nova_db', 'root', '');
    session_start();