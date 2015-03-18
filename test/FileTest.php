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

class FileTest extends PHPUnit_Framework_TestCase {

    /** @var File - Testing instance */
    protected $_object;

    protected function setUp()
    {

    }

    public function testUpload()
    {
        $this->_object = new File('http://pm.loc.dev/assets/Koala.jpg');
        $this->assertInstanceOf('File', $this->_object);
    }

    /** @depends testCreate */
    public function testSave()
    {
        $savePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'myKoala.png';
        if (!file_exists($savePath)) {
            $this->_object->saveFileTo($savePath);
            $this->assertFileExists($savePath);
        }
    }

    /** @depends testSave */
    public function testSaveOverwrite()
    {
        $savePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'myKoala.png';
        if (file_exists($savePath)) {
            $this->_object->saveFileTo($savePath, true);
            $this->assertFileExists($savePath);
            unlink($savePath);
        }
    }

//    public static function init()
//    {
//        $success  = false;
//        $savePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'myKoala.png';
//        try {
//            $file = new File('http://pm.loc.dev/assets/Koala.jpg');
//            $file->saveFileTo($savePath, true);
//            $success = true;
//        } catch (\Exception $e) {
//            $success = false;
//        } finally {
//            if ($success)
//                echo "File was uploaded and save to $savePath";
//            else
//                echo "File was not saved.";
//        }
//    }
} 