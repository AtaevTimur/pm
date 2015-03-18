<?php
/**
 * Created by PhpStorm.
 * User: ataev
 * Date: 18.03.15
 * Time: 13:12
 */

namespace file;

use Exception;

/**
 * FileException Extended with constants Exception class
 *
 * @package file
 * @author Ataev TImur <timur.ataev.dev@gmail.com>
 * @version 1.0
 */
class FileException extends Exception {
    const EMPTY_FILE_PATH      = 101;
    const EMPTY_SAVE_PATH      = 102;
    const EMPTY_UPLOADED_FILE  = 103;
    const EMPTY_SAVED_FILE     = 104;
    const WRONG_FILE_EXTENSION = 105;
    const FILE_ALREADY_EXIST   = 106;
}