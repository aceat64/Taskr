<?php
namespace App\View\Helper;

use Cake\View\Helper;

/**
 * Helper to access auth user data.
 *
 */
class UserDataHelper extends Helper
{

    public function __call($data, $exists = false)
    {
        if (!isset($this->_View->viewVars['userData'][$data])) {
            return false;
        }

        if ($exists === true && isset($this->_View->viewVars['userData'][$data])) {
            return true;
        }

        return $this->_View->viewVars['userData'][$data];
    }
}
