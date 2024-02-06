<?php

namespace Omnipay\Azkivam\Message;


/**
 * @package Omnipay\Azkivam
 * @author Amirreza Salari <amirrezasalari1997@gmail.com>
 */

/**
 * Class AbstractResponse
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    /**
     * @var array
     */
    protected $errorCodes = [

        0 => "Request finished successfully",
        1 => "Internal Server Error",
        2 => "Resource Not Found",
        4 => "Malformed Data",
        5 => "Data Not Found",
        15 =>  "Access Denied",
        16 =>  "Transaction already reversed",
        17 =>  "Ticket Expired",
        18 =>  "Signature Invalid",
        19 =>  "Ticket unpayable",
        20 =>  "Ticket customer mismatch",
        21 =>  "Insufficient Credit",
        28 =>  "Unverifiable ticket due to status",
        32 =>  "Invalid Invoice Data",
        33 =>  "Contract is not started",
        34 =>  "Contract is expired",
        44 =>  "Validation exception",
        51 =>  "Request data is not valid",
        59 =>  "Transaction not reversible",
        60 =>  "Transaction must be in verified state",
    ];

    /**
     * Response Message
     *
     * @return null|string A response message from the payment gateway
     */
    public function getMessage($code = "") :string
    {
        if($code !== ""){
            return $this->errorCodes[$code];
        }
        return $this->errorCodes[(string)$this->getCode()] ?? parent::getMessage();
    }

    /**
     * Response code
     *
     * @return null|string A response code from the payment gateway
     */
    public function getCode() :string
    {
        return $this->data['rsCode'] ?? parent::getCode();
    }

    /**
     * Http status code
     *
     * @return int A response code from the payment gateway
     */
    public function getHttpStatus(): int
    {
        return (int)($this->data['httpStatus'] ?? null);
    }
}