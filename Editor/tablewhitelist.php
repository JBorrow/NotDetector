<?php

//use this to store the table white list.

function inWhiteList($tablename)
{
    $wl = getWhiteList();
    if (in_array($tablename, $wl)) {
        return true;
    } else {
        return false;
    }
}

function getWhiteList()
{
    return array('news');
}
