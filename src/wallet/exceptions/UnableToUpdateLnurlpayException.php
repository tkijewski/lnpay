<?php

namespace lnpay\wallet\exceptions;

use yii\web\ServerErrorHttpException;

class UnableToUpdateLnurlpayException extends ServerErrorHttpException
{
    /**
     * Constructor.
     *
     * @param string     $path
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($program_name, $code = 0, \yii\base\Exception $previous = null)
    {
        parent::__construct( $program_name, $code, $previous);
    }
}