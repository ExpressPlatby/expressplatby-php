<?php

namespace ExpressPayments\Exception;

/**
 * CardException is thrown when a user enters a card that can't be charged for
 * some reason.
 */
class CardException extends ApiErrorException
{
    protected $declineCode;
    protected $expressPaymentsParam;

    /**
     * Creates a new CardException exception.
     *
     * @param string $message the exception message
     * @param null|int $httpStatus the HTTP status code
     * @param null|string $httpBody the HTTP body as a string
     * @param null|array $jsonBody the JSON deserialized body
     * @param null|array|\ExpressPayments\Util\CaseInsensitiveArray $httpHeaders the HTTP headers array
     * @param null|string $expressPaymentsCode the ExpressPayments error code
     * @param null|string $declineCode the decline code
     * @param null|string $expressPaymentsParam the parameter related to the error
     *
     * @return CardException
     */
    public static function factory(
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null,
        $expressPaymentsCode = null,
        $declineCode = null,
        $expressPaymentsParam = null
    ) {
        $instance = parent::factory($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders, $expressPaymentsCode);
        $instance->setDeclineCode($declineCode);
        $instance->setExpressPaymentsParam($expressPaymentsParam);

        return $instance;
    }

    /**
     * Gets the decline code.
     *
     * @return null|string
     */
    public function getDeclineCode()
    {
        return $this->declineCode;
    }

    /**
     * Sets the decline code.
     *
     * @param null|string $declineCode
     */
    public function setDeclineCode($declineCode)
    {
        $this->declineCode = $declineCode;
    }

    /**
     * Gets the parameter related to the error.
     *
     * @return null|string
     */
    public function getExpressPaymentsParam()
    {
        return $this->expressPaymentsParam;
    }

    /**
     * Sets the parameter related to the error.
     *
     * @param null|string $expressPaymentsParam
     */
    public function setExpressPaymentsParam($expressPaymentsParam)
    {
        $this->expressPaymentsParam = $expressPaymentsParam;
    }
}
