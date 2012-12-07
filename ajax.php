<?php

require_once('functions.php');

if(isset($_POST['ajax'])){
    die(get_ajax_token());
}