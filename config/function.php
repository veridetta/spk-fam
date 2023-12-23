<?php
function kepuasan($presentase){
    if ($presentase <= 21) {
        return "Tidak Puas";
    } elseif ($presentase <= 41) {
        return "Kurang Puas";
    } elseif ($presentase <= 61) {
        return "Cukup Puas";
    } elseif ($presentase <= 81) {
        return "Puas";
    } else {
        return "Sangat Puas";
    }
}
?>