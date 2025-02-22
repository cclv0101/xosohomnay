<?php

if (in_array($type, array(0,1,2))) {
    header('location: ' . URL_DOMAIN . '/admin/service/list' . URL_FOOT);
}else{
    header('location: ' . URL_DOMAIN . '/admin/dashboard' . URL_FOOT);
}