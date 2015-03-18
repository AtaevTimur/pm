<?php


namespace file;

use SplFileInfo;

/**
 * File is the class of Image file upload
 *
 * @package file
 * @author Ataev TImur <timur.ataev.dev@gmail.com>
 * @version 1.0
 */
class File {
    /** @var SplFileInfo - Information about file */
    private $_fileInfo;

    /** @var string - Entire file in a string */
    private $_fileData;

    /** @var string - Path to the file that must be uploaded to server */
    private $_filePath;

    /** @var string - Path to place where file must be saved */
    private $_savePath;

    /** @var array - Available image extensions that could be uploaded */
    private $_availableExtensions = ['jpg', 'png', 'gif'];

    /**
     * Constructor
     *
     * Create File instance that includes the uploaded file(image) by the filePath
     *
     * @param string $filePath Path to the file that must be uploaded to server
     * @throws FileException
     */
    public function __construct($filePath)
    {
        if (!$filePath)
            throw new FileException('Empty path to file.', FileException::EMPTY_FILE_PATH);

        $this->_filePath = $filePath;
        $this->_fileData = file_get_contents($this->_filePath);
        if (!$this->_fileData)
            throw new FileException('File could not be loaded.', FileException::EMPTY_UPLOADED_FILE);
        $this->_fileInfo = new SplFileInfo($this->_filePath);

        if (!in_array($this->_fileInfo->getExtension(), $this->_availableExtensions))
            throw new FileException('File extension is not available.', FileException::WRONG_FILE_EXTENSION);
    }

    /**
     * Save file to the path
     * Path must be absolute and have the desired file name with extension
     *
     * @param string $savePath
     * @param bool $overwrite Overwrites existed file if set to true
     * @throws FileException
     */
    public function saveFileTo($savePath, $overwrite = false)
    {
        if (!$savePath)
            throw new FileException('Empty save path.', FileException::EMPTY_SAVE_PATH);

        $overwrite = $overwrite ? FILE_APPEND : null;
        $writtenNumberOfBytes = null;

        $this->_savePath = $savePath;
        if (file_exists($this->_savePath) and !$overwrite)
            throw new FileException('File with such name already exist and overwrite is not installed.', FileException::FILE_ALREADY_EXIST);
        else
            $writtenNumberOfBytes = file_put_contents($this->_savePath, $this->_fileData, $overwrite);

        if (!$writtenNumberOfBytes)
            throw new FileException('File was not written to the FS.', FileException::EMPTY_SAVED_FILE);
    }
}