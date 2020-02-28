<?php

use App\Hotel;

if (!function_exists('hotel_information')) {
  function hotel_information()
  {
    $gl_setting = Hotel::first();

    return $gl_setting;
  }
}

if (!function_exists('days_arr')) {
  function days_arr()
  {
    return [
      1 => 'sunday',
      2 => 'monday',
      3 => 'thursday',
      4 => 'wednesday',
      5 => 'tuesday',
      6 => 'friday',
      7 => 'saturday',
    ];
  }
}
if (!function_exists('month_arr')) {
  function month_arr()
  {
    return [
      1 => 'January',
      2 => 'February',
      3 => 'March',
      4 => 'April',
      5 => 'May',
      6 => 'June',
      7 => 'July',
      8 => 'August',
      9 => 'September',
      10 => 'October',
      11 => 'November',
      12 => 'December'
    ];
  }
}
