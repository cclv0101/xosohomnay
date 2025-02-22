<?php

if (in_array($type, array(0))) {
    header('location: ' . URL_DOMAIN . '/admin/user/list' . URL_FOOT);
}else{
    header('location: ' . URL_DOMAIN . '/admin/dashboard' . URL_FOOT);
}