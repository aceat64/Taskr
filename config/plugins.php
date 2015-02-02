<?php
$baseDir = dirname(dirname(__FILE__));
return array (
  'plugins' => 
  array (
    'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
    'Bake' => $baseDir . '/vendor/cakephp/bake/',
    'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
  ),
);