<?php
// functions.php

function tinhTong($a, $b)
{
    return $a + $b;
}

function tinhHieu($a, $b)
{
    return $a - $b;
}

function tinhTich($a, $b)
{
    return $a * $b;
}

function tinhThuong($a, $b)
{
    if ($b == 0) {
        return "Không thể chia cho 0";
    } else {
        return $a / $b;
    }
}

function kiemTraNguyenTo($n)
{
    if ($n <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

function kiemTraChan($n)
{
    return $n % 2 == 0;
}
