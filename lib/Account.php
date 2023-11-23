<?php

// File generated from our OpenAPI spec

namespace ExpressPayments;

/**
 * This is an object representing an ExpressPayments account. You can retrieve it to see
 * properties on the account like its current requirements or if the account is
 * enabled to make live charges or receive payouts.
 *
 * For Custom accounts, the properties below are always returned. For other accounts, some properties are returned until that
 * account has started to go through Connect Onboarding. Once you create an <a href="https://docs.epayments.network/api/account_links">Account Link</a>
 * for a Standard or Express account, some parameters are no longer returned. These are marked as <strong>Custom Only</strong> or <strong>Custom and Express</strong>
 * below. Learn about the differences <a href="https://docs.epayments.network/connect/accounts">between accounts</a>.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property null|\ExpressPayments\ExpressPaymentsObject $business_profile Business information about the account.
 * @property null|string $business_type The business type.
 * @property null|\ExpressPayments\ExpressPaymentsObject $capabilities
 * @property null|bool $charges_enabled Whether the account can create live charges.
 * @property null|\ExpressPayments\ExpressPaymentsObject $company
 * @property null|\ExpressPayments\ExpressPaymentsObject $controller
 * @property null|string $country The account's country.
 * @property null|int $created Time at which the account was connected. Measured in seconds since the Unix epoch.
 * @property null|string $default_currency Three-letter ISO currency code representing the default currency for the account. This must be a currency that <a href="https://docs.epayments.network/payouts">ExpressPayments supports in the account's country</a>.
 * @property null|bool $details_submitted Whether account details have been submitted. Standard accounts cannot receive payouts before this is true.
 * @property null|string $email An email address associated with the account. It's not used for authentication and ExpressPayments doesn't market to this field without explicit approval from the platform.
 * @property null|\ExpressPayments\Collection<\ExpressPayments\BankAccount|\ExpressPayments\Card> $external_accounts External accounts (bank accounts and debit cards) currently attached to this account
 * @property null|\ExpressPayments\ExpressPaymentsObject $future_requirements
 * @property null|\ExpressPayments\Person $individual <p>This is an object representing a person associated with an ExpressPayments account.</p><p>A platform cannot access a Standard or Express account's persons after the account starts onboarding, such as after generating an account link for the account. See the <a href="https://docs.epayments.network/connect/standard-accounts">Standard onboarding</a> or <a href="https://docs.epayments.network/connect/express-accounts">Express onboarding documentation</a> for information about platform prefilling and account onboarding steps.</p><p>Related guide: <a href="https://docs.epayments.network/connect/handling-api-verification#person-information">Handling identity verification with the API</a></p>
 * @property null|\ExpressPayments\ExpressPaymentsObject $metadata Set of <a href="https://docs.epayments.network/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 * @property null|bool $payouts_enabled Whether ExpressPayments can send payouts to this account.
 * @property null|\ExpressPayments\ExpressPaymentsObject $requirements
 * @property null|\ExpressPayments\ExpressPaymentsObject $settings Options for customizing how the account functions within ExpressPayments.
 * @property null|\ExpressPayments\ExpressPaymentsObject $tos_acceptance
 * @property null|string $type The ExpressPayments account type. Can be <code>standard</code>, <code>express</code>, or <code>custom</code>.
 */
class Account extends ApiResource
{
    const OBJECT_NAME = 'account';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\NestedResource;
    use ApiOperations\Update;

    const BUSINESS_TYPE_COMPANY = 'company';
    const BUSINESS_TYPE_GOVERNMENT_ENTITY = 'government_entity';
    const BUSINESS_TYPE_INDIVIDUAL = 'individual';
    const BUSINESS_TYPE_NON_PROFIT = 'non_profit';

    const TYPE_CUSTOM = 'custom';
    const TYPE_EXPRESS = 'express';
    const TYPE_STANDARD = 'standard';

    use ApiOperations\Retrieve {
        retrieve as protected _retrieve;
    }

    public static function getSavedNestedResources()
    {
        static $savedNestedResources = null;
        if (null === $savedNestedResources) {
            $savedNestedResources = new Util\Set([
                'external_account',
                'bank_account',
            ]);
        }

        return $savedNestedResources;
    }

    public function instanceUrl()
    {
        if (null === $this['id']) {
            return '/v1/account';
        }

        return parent::instanceUrl();
    }

    /**
     * @param null|array|string $id the ID of the account to retrieve, or an
     *     options array containing an `id` key
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Account
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function retrieve($id = null, $opts = null)
    {
        if (!$opts && \is_string($id) && 'sk_' === \substr($id, 0, 3)) {
            $opts = $id;
            $id = null;
        }

        return self::_retrieve($id, $opts);
    }

    public function serializeParameters($force = false)
    {
        $update = parent::serializeParameters($force);
        if (isset($this->_values['legal_entity'])) {
            $entity = $this['legal_entity'];
            if (isset($entity->_values['additional_owners'])) {
                $owners = $entity['additional_owners'];
                $entityUpdate = isset($update['legal_entity']) ? $update['legal_entity'] : [];
                $entityUpdate['additional_owners'] = $this->serializeAdditionalOwners($entity, $owners);
                $update['legal_entity'] = $entityUpdate;
            }
        }
        if (isset($this->_values['individual'])) {
            $individual = $this['individual'];
            if (($individual instanceof Person) && !isset($update['individual'])) {
                $update['individual'] = $individual->serializeParameters($force);
            }
        }

        return $update;
    }

    private function serializeAdditionalOwners($legalEntity, $additionalOwners)
    {
        if (isset($legalEntity->_originalValues['additional_owners'])) {
            $originalValue = $legalEntity->_originalValues['additional_owners'];
        } else {
            $originalValue = [];
        }
        if (($originalValue) && (\count($originalValue) > \count($additionalOwners))) {
            throw new Exception\InvalidArgumentException(
                'You cannot delete an item from an array, you must instead set a new array'
            );
        }

        $updateArr = [];
        foreach ($additionalOwners as $i => $v) {
            $update = ($v instanceof ExpressPaymentsObject) ? $v->serializeParameters() : $v;

            if ([] !== $update) {
                if (!$originalValue
                    || !\array_key_exists($i, $originalValue)
                    || ($update !== $legalEntity->serializeParamsValue($originalValue[$i], null, false, true))) {
                    $updateArr[$i] = $update;
                }
            }
        }

        return $updateArr;
    }

    /**
     * @param null|array $clientId
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\ExpressPaymentsObject object containing the response from the API
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function deauthorize($clientId = null, $opts = null)
    {
        $params = [
            'client_id' => $clientId,
            'ep_user_id' => $this->id,
        ];

        return OAuth::deauthorize($params, $opts);
    }

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Account the rejected account
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function reject($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/reject';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }

    const PATH_CAPABILITIES = '/capabilities';

    /**
     * @param string $id the ID of the account on which to retrieve the capabilities
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Collection<\ExpressPayments\Capability> the list of capabilities
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function allCapabilities($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_CAPABILITIES, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the capability belongs
     * @param string $capabilityId the ID of the capability to retrieve
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Capability
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function retrieveCapability($id, $capabilityId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_CAPABILITIES, $capabilityId, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the capability belongs
     * @param string $capabilityId the ID of the capability to update
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Capability
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function updateCapability($id, $capabilityId, $params = null, $opts = null)
    {
        return self::_updateNestedResource($id, static::PATH_CAPABILITIES, $capabilityId, $params, $opts);
    }
    const PATH_EXTERNAL_ACCOUNTS = '/external_accounts';

    /**
     * @param string $id the ID of the account on which to retrieve the external accounts
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Collection<\ExpressPayments\BankAccount|\ExpressPayments\Card> the list of external accounts (BankAccount or Card)
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function allExternalAccounts($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_EXTERNAL_ACCOUNTS, $params, $opts);
    }

    /**
     * @param string $id the ID of the account on which to create the external account
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\BankAccount|\ExpressPayments\Card
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function createExternalAccount($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_EXTERNAL_ACCOUNTS, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the external account belongs
     * @param string $externalAccountId the ID of the external account to delete
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\BankAccount|\ExpressPayments\Card
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function deleteExternalAccount($id, $externalAccountId, $params = null, $opts = null)
    {
        return self::_deleteNestedResource($id, static::PATH_EXTERNAL_ACCOUNTS, $externalAccountId, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the external account belongs
     * @param string $externalAccountId the ID of the external account to retrieve
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\BankAccount|\ExpressPayments\Card
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function retrieveExternalAccount($id, $externalAccountId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_EXTERNAL_ACCOUNTS, $externalAccountId, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the external account belongs
     * @param string $externalAccountId the ID of the external account to update
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\BankAccount|\ExpressPayments\Card
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function updateExternalAccount($id, $externalAccountId, $params = null, $opts = null)
    {
        return self::_updateNestedResource($id, static::PATH_EXTERNAL_ACCOUNTS, $externalAccountId, $params, $opts);
    }
    const PATH_LOGIN_LINKS = '/login_links';

    /**
     * @param string $id the ID of the account on which to create the login link
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\LoginLink
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function createLoginLink($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_LOGIN_LINKS, $params, $opts);
    }
    const PATH_PERSONS = '/persons';

    /**
     * @param string $id the ID of the account on which to retrieve the persons
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Collection<\ExpressPayments\Person> the list of persons
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function allPersons($id, $params = null, $opts = null)
    {
        return self::_allNestedResources($id, static::PATH_PERSONS, $params, $opts);
    }

    /**
     * @param string $id the ID of the account on which to create the person
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Person
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function createPerson($id, $params = null, $opts = null)
    {
        return self::_createNestedResource($id, static::PATH_PERSONS, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the person belongs
     * @param string $personId the ID of the person to delete
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Person
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function deletePerson($id, $personId, $params = null, $opts = null)
    {
        return self::_deleteNestedResource($id, static::PATH_PERSONS, $personId, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the person belongs
     * @param string $personId the ID of the person to retrieve
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Person
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function retrievePerson($id, $personId, $params = null, $opts = null)
    {
        return self::_retrieveNestedResource($id, static::PATH_PERSONS, $personId, $params, $opts);
    }

    /**
     * @param string $id the ID of the account to which the person belongs
     * @param string $personId the ID of the person to update
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Person
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function updatePerson($id, $personId, $params = null, $opts = null)
    {
        return self::_updateNestedResource($id, static::PATH_PERSONS, $personId, $params, $opts);
    }
}
