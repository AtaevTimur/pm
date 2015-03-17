<?php
/**
 * Created by PhpStorm.
 * User: ataev
 * Date: 16.03.15
 * Time: 15:51
 */

namespace test;


use file\File;
use PHPUnit_Framework_TestCase;

class Test extends PHPUnit_Framework_TestCase {
    public static function init()
    {
        try {
            $file = new File('http://pm.loc.dev/assets/Koala.jpg');
            $savePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'myKoala.png';
            $file->saveFileTo($savePath);
        } catch (\Exception $e) {
            echo $e->getMessage();
        } finally {
            echo '<br>Something was executed.';
        }
    }
} 