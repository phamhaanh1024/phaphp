<?php
function timGiaTriLonNhat($mang) {
    return max($mang);
}

function timGiaTriNhoNhat($mang) {
    return min($mang);
}

function tinhTongMang($mang) {
    return array_sum($mang);
}

function kiemTraPhanTuCoThuocMang($mang, $phantu) {
    return in_array($phantu, $mang);
}

function sapXepMangTangDan($mang) {
    sort($mang);
    return $mang;
}
?>
