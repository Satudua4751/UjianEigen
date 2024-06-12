<?php

if (!function_exists('floatVal')) {
    function floatVal($value)
    {
        if (is_string($value)) {
            // Remove any commas or dollar signs
            $value = str_replace(['$', ','], '', $value);
            // Convert to float
            return floatval($value);
        } elseif (is_numeric($value)) {
            // Return the numeric value as is
            return floatval($value);
        } else {
            // Return 0 for any other type
            return 0.0;
        }
    }
}

function angkaTerbilang($x)
{
    $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return angkaTerbilang($x - 10) . " belas";
    elseif ($x < 100)
        return angkaTerbilang($x / 10) . " puluh" . angkaTerbilang($x % 10);
    elseif ($x < 200)
        return " seratus" . angkaTerbilang($x - 100);
    elseif ($x < 1000)
        return angkaTerbilang($x / 100) . " ratus" . angkaTerbilang($x % 100);
    elseif ($x < 2000)
        return " seribu" . angkaTerbilang($x - 1000);
    elseif ($x < 1000000)
        return angkaTerbilang($x / 1000) . " ribu" . angkaTerbilang($x % 1000);
    elseif ($x < 1000000000)
        return angkaTerbilang($x / 1000000) . " juta" . angkaTerbilang($x % 1000000);
}
