<?php
include_once 'context.php';
// The structure leading to root
global $_DOMAIN;
// The amount of leagues updated per cycle

if($_CONTEXT==="SERVER") {
    $_DOMAIN = "/home/a1202530/public_html";
}
else if($_CONTEXT==="DEVELOPMENT") {
    $_DOMAIN = "";
}

else {
    echo "Error: Unknown context!";
}