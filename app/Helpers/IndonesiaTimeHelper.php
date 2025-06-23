<?php

namespace App\Helpers;

use Carbon\Carbon;

class IndonesiaTimeHelper
{
   
    public static function diffForHumans($date)
    {
        if (!$date) {
            return 'Baru';
        }
        

        Carbon::setLocale('id');
        
        if (!($date instanceof Carbon)) {
            $date = new Carbon($date);
        }
        
        $diff = $date->diffForHumans();
        
 
        $translations = [
            'ago' => 'yang lalu',
            'from now' => 'dari sekarang',
            'second' => 'detik',
            'seconds' => 'detik',
            'minute' => 'menit',
            'minutes' => 'menit',
            'hour' => 'jam',
            'hours' => 'jam',
            'day' => 'hari',
            'days' => 'hari',
            'week' => 'minggu',
            'weeks' => 'minggu',
            'month' => 'bulan',
            'months' => 'bulan',
            'year' => 'tahun',
            'years' => 'tahun',
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];
        
        foreach ($translations as $english => $indonesian) {
            $diff = str_replace($english, $indonesian, $diff);
        }
        
        return $diff;
    }
    
    
    public static function formatDate($date, $format = 'j F Y')
    {
        if (!($date instanceof Carbon)) {
            $date = new Carbon($date);
        }
        

        $date->locale('id');
        
        return $date->translatedFormat($format);
    }
    public static function formatDateShort($date, $format = 'F Y')
    {
        if (!($date instanceof Carbon)) {
            $date = new Carbon($date);
        }
        
        $date->locale('id');
        
        return $date->translatedFormat($format);
    }

     public static function formatDateJam($date, $format = 'j')
    {
        if (!($date instanceof Carbon)) {
            $date = new Carbon($date);
        }
        
        $date->locale('id');
        
        return $date->translatedFormat($format);
    }

     public static function formatDateMonth($date, $format = 'F')
    {
        if (!($date instanceof Carbon)) {
            $date = new Carbon($date);
        }
        
        $date->locale('id');
        
        return $date->translatedFormat($format);
    }
}