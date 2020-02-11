<?php

use App\Hotel;

if (!function_exists('general_setting')) {
    function general_setting()
    {
      $gl_setting = Hotel::first();

      return $gl_setting;
    }
  }
  