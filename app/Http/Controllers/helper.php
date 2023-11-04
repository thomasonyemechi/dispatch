<?php

function defff()
{
    return true;
}


function getExt($file) {
    $file = explode('.', $file);
    $ext = $file[1];
    $val = 'bx-file text-primary ';
    if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' ) {
        $val = 'bx-image text-info ';
    }elseif($ext == 'zip' || $ext == 'rar') {
        $val = 'bx-file-blank text-warning';
    }

    return $val;
}