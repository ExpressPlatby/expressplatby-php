<?php

// File generated from our OpenAPI spec

namespace ExpressPlatby\Service\FinancialConnections;

class AccountService extends \ExpressPlatby\Service\AbstractService
{
    /**
     * Returns a list of Financial Connections <code>Account</code> objects.
     *
     * @param null|array $params
     * @param null|array|\ExpressPlatby\Util\RequestOptions $opts
     *
     * @throws \ExpressPlatby\Exception\ApiErrorException if the request fails
     *
     * @return \ExpressPlatby\Collection<\ExpressPlatby\FinancialConnections\Account>
     */
    public function all($params = null, $opts = null)
    {
        return $this->requestCollection('get', '/v1/financial_connections/accounts', $params, $opts);
    }

    /**
     * Lists all owners for a given <code>Account</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\ExpressPlatby\Util\RequestOptions $opts
     *
     * @throws \ExpressPlatby\Exception\ApiErrorException if the request fails
     *
     * @return \ExpressPlatby\Collection<\ExpressPlatby\FinancialConnections\AccountOwner>
     */
    public function allOwners($id, $params = null, $opts = null)
    {
        return $this->requestCollection('get', $this->buildPath('/v1/financial_connections/accounts/%s/owners', $id), $params, $opts);
    }

    /**
     * Disables your access to a Financial Connections <code>Account</code>. You will
     * no longer be able to access data associated with the account (e.g. balances,
     * transactions).
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\ExpressPlatby\Util\RequestOptions $opts
     *
     * @throws \ExpressPlatby\Exception\ApiErrorException if the request fails
     *
     * @return \ExpressPlatby\FinancialConnections\Account
     */
    public function disconnect($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/financial_connections/accounts/%s/disconnect', $id), $params, $opts);
    }

    /**
     * Refreshes the data associated with a Financial Connections <code>Account</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\ExpressPlatby\Util\RequestOptions $opts
     *
     * @throws \ExpressPlatby\Exception\ApiErrorException if the request fails
     *
     * @return \ExpressPlatby\FinancialConnections\Account
     */
    public function refresh($id, $params = null, $opts = null)
    {
        return $this->request('post', $this->buildPath('/v1/financial_connections/accounts/%s/refresh', $id), $params, $opts);
    }

    /**
     * Retrieves the details of an Financial Connections <code>Account</code>.
     *
     * @param string $id
     * @param null|array $params
     * @param null|array|\ExpressPlatby\Util\RequestOptions $opts
     *
     * @throws \ExpressPlatby\Exception\ApiErrorException if the request fails
     *
     * @return \ExpressPlatby\FinancialConnections\Account
     */
    public function retrieve($id, $params = null, $opts = null)
    {
        return $this->request('get', $this->buildPath('/v1/financial_connections/accounts/%s', $id), $params, $opts);
    }
}
