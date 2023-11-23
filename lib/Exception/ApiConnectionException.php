<?php

namespace ExpressPayments\Exception;

/**
 * ApiConnection is thrown in the event that the SDK can't connect to ExpressPayments'
 * servers. That can be for a variety of different reasons from a downed
 * network to a bad TLS certificate.
 */
class ApiConnectionException extends ApiErrorException
{
}
