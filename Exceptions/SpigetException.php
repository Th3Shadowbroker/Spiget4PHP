<?php

/*
    Copyright (c) 2018 Jens F.

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 */

/**
 * Created by Jens F. https://m4taiori.de
 * GitHub: https://github.com/th3shadowbroker
 * Date: 30.06.2018
 * Time: 15:38
 */

namespace de\m4taiori\spiget4php\exceptions;

use Exception;
use Throwable;

/**
 * An exception thrown by invalid API results.
 * Class SpigetException
 */
class SpigetException extends Exception
{

    /**
     * @var int The error-code transmitted by the API.
     */
    private $http_error_code = null;

    /**
     * SpigetException constructor.
     * @param string $message The error-message.
     * @param int $http_code The http-error code.
     * @param int $code The error-code. NOT the http-error-code!
     * @param Throwable|null $previous The previous throwable.
     */
    function __construct($message = "", $http_code = 0, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->http_error_code = $http_code;
    }

    /**
     * Get the http-error code.
     * @return int
     */
    public function getHttpErrorCode()
    {
        return $this->http_error_code;
    }



}