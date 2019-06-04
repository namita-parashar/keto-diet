<?php

namespace App\Library;

class Functions {

  public static function convert_to_cm($feet , $inches = 0)
  {
    $inches = ($feet *12) + $inches;
    return (int) round($inches /0.393701);
  }


}
