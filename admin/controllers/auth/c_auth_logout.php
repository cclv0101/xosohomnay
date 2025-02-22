<?php

setcookie('DataTokenAuth', "", time() - 3600, "/");
echo 'success';
