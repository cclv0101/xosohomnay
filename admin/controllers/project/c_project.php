<?php

if (in_array($type, array(0,1,2))) {
    header('location: ' . URL_DOMAIN . '/admin/project/list' . URL_FOOT);
}else{
    header('location: ' . URL_DOMAIN . '/admin/dashboard' . URL_FOOT);
}