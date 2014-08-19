<?php

//use this to store the table white list.

function inWhiteList($tablename)
{
    $wl = array('news');
    if (in_array($tablename, $wl)) {
        return true;
    } else {
        return false;
    }
}
