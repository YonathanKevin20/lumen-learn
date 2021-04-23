<?php

function getPaginationArray($page, $last_page)
{    
    $arr = [];
    $awal = 1;
    $akhir = $last_page;

    if ($akhir > 5) $akhir = 5;

    if ($page > 3) {
        $awal = $page - 2;
        $akhir = $page + 2;

        if ($last_page - $page == 1 || $last_page == $page) {
            $akhir = $last_page;
            $awal = $last_page - 4;

            if ($awal == 0) {
                $awal = 1;
            }
        }
    }

    $no = 0;
    for ($i = $awal; $i <= $akhir; $i++) {
        $arr[$no] = $i;

        $no += 1;
    }
    return $arr;
}