<?php

// File generated from our OpenAPI spec

namespace ExpressPayments\Service\Treasury;

class InboundTransferService extends \ExpressPayments\Service\AbstractService
{
    /**
     * Returns a list of InboundTransfers sent from the specified FinancialAccount.
     *
     * @param null|array $params
     * @param null|array|\ExpressPayments\Util\RequestOptions $opts
     *
     * @return \ExpressPayments\Collection<\ExpressPayments\Treasury\InboundTransfer>
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/treasury/inbound_transfers', $params, $opts);
    }

    /**
     * Cancels an InboundTransfer.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\ExpressPayments\Util\RequestOptions $opts
     *
     * @return \ExpressPayments\Treasury\InboundTransfer
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function cancel($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/treasury/inbound_transfers/%s/cancel', $id), $params, $opts);
    }

    /**
     * Creates an InboundTransfer.
     *
     * @param null|array $params
     * @param null|array|\ExpressPayments\Util\RequestOptions $opts
     *
     * @return \ExpressPayments\Treasury\InboundTransfer
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function create($params = null, $opts = null)
    {
        return $this->request('post', '/v1/treasury/inbound_transfers', $params, $opts);
    }

    /**
     * Retrieves the details of an existing InboundTransfer.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\ExpressPayments\Util\RequestOptions $opts
     *
     * @return \ExpressPayments\Treasury\InboundTransfer
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/treasury/inbound_transfers/%s', $id), $params, $opts);
    }
}
