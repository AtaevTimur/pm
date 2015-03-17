<?php
/**
 * Created by PhpStorm.
 * User: ataev
 * Date: 16.03.15
 * Time: 14:34
 */

namespace file;


use Exception;
use SplFileInfo;

class File {
    /** @property $_fileInfo SplFileInfo */
    private $_fileInfo;
    private $_fileData;
    private $_filePath;
    private $_savePath;
    private $_availableExtensions = ['jpg', 'png', 'gif'];

    public function __construct($filePath)
    {
        if (!$filePath)
            throw new Exception('Empty path to file.');

        $this->_filePath = $filePath;
        $this->_fileData = file_get_contents($this->_filePath);
        if (!$this->_fileData)
            throw new Exception('Resource could not be loaded.');
        $this->_fileInfo = new SplFileInfo($this->_filePath);

        if (!in_array($this->_fileInfo->getExtension(), $this->_availableExtensions))
            throw new Exception('File extension is not available.');
    }

    public function __destruct()
    {

    }

    public function saveFileTo($savePath, $overwrite = false)
    {
        if (!$savePath)
            throw new Exception('Empty save path.');
        if (!$this->_fileData)
            throw new Exception('Empty file data resource.');

        $this->_savePath = $savePath;

        if (file_exists($this->_savePath) and !$overwrite)
            throw new Exception('File with such name already exist and overwrite is not installed.');
        elseif ($overwrite)
            file_put_contents($this->_savePath, $this->_fileData, FILE_APPEND);
        else
            file_put_contents($this->_savePath, $this->_fileData);
    }
}