<?php

use App\Hotel;

if (!function_exists('hotel_information')) {
    function hotel_information()
    {
      $gl_setting = Hotel::first();

      return $gl_setting;
    }
  }
  