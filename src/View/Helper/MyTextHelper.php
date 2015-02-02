<?php
namespace App\View\Helper;

use Cake\View\Helper\TextHelper;

class MyTextHelper extends TextHelper
{
    /**
    * Used to create slugs.
    *
    */
    public function slug($string){
        return preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    }
}
