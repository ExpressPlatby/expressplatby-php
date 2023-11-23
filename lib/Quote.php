<?php

// File generated from our OpenAPI spec

namespace ExpressPayments;

/**
 * A Quote is a way to model prices that you'd like to provide to a customer.
 * Once accepted, it will automatically create an invoice, subscription or subscription schedule.
 *
 * @property string $id Unique identifier for the object.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property int $amount_subtotal Total before any discounts or taxes are applied.
 * @property int $amount_total Total after discounts and taxes are applied.
 * @property null|string|\ExpressPayments\ExpressPaymentsObject $application ID of the Connect Application that created the quote.
 * @property null|int $application_fee_amount The amount of the application fee (if any) that will be requested to be applied to the payment and transferred to the application owner's ExpressPayments account. Only applicable if there are no line items with recurring prices on the quote.
 * @property null|float $application_fee_percent A non-negative decimal between 0 and 100, with at most two decimal places. This represents the percentage of the subscription invoice total that will be transferred to the application owner's ExpressPayments account. Only applicable if there are line items with recurring prices on the quote.
 * @property \ExpressPayments\ExpressPaymentsObject $automatic_tax
 * @property string $collection_method Either <code>charge_automatically</code>, or <code>send_invoice</code>. When charging automatically, ExpressPayments will attempt to pay invoices at the end of the subscription cycle or on finalization using the default payment method attached to the subscription or customer. When sending an invoice, ExpressPayments will email your customer an invoice with payment instructions and mark the subscription as <code>active</code>. Defaults to <code>charge_automatically</code>.
 * @property \ExpressPayments\ExpressPaymentsObject $computed
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property null|string $currency Three-letter <a href="https://www.iso.org/iso-4217-currency-codes.html">ISO currency code</a>, in lowercase. Must be a <a href="https://docs.epayments.network/currencies">supported currency</a>.
 * @property null|string|\ExpressPayments\Customer $customer The customer which this quote belongs to. A customer is required before finalizing the quote. Once specified, it cannot be changed.
 * @property null|(string|\ExpressPayments\TaxRate)[] $default_tax_rates The tax rates applied to this quote.
 * @property null|string $description A description that will be displayed on the quote PDF.
 * @property (string|\ExpressPayments\Discount)[] $discounts The discounts applied to this quote.
 * @property int $expires_at The date on which the quote will be canceled if in <code>open</code> or <code>draft</code> status. Measured in seconds since the Unix epoch.
 * @property null|string $footer A footer that will be displayed on the quote PDF.
 * @property null|\ExpressPayments\ExpressPaymentsObject $from_quote Details of the quote that was cloned. See the <a href="https://docs.epayments.network/quotes/clone">cloning documentation</a> for more details.
 * @property null|string $header A header that will be displayed on the quote PDF.
 * @property null|string|\ExpressPayments\Invoice $invoice The invoice that was created from this quote.
 * @property null|\ExpressPayments\ExpressPaymentsObject $invoice_settings All invoices will be billed using the specified settings.
 * @property null|\ExpressPayments\Collection<\ExpressPayments\LineItem> $line_items A list of items the customer is being quoted for.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property \ExpressPayments\ExpressPaymentsObject $metadata Set of <a href="https://docs.epayments.network/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 * @property null|string $number A unique number that identifies this particular quote. This number is assigned once the quote is <a href="https://docs.epayments.network/quotes/overview#finalize">finalized</a>.
 * @property null|string|\ExpressPayments\Account $on_behalf_of The account on behalf of which to charge. See the <a href="https://support.epayments.network/questions/sending-invoices-on-behalf-of-connected-accounts">Connect documentation</a> for details.
 * @property string $status The status of the quote.
 * @property \ExpressPayments\ExpressPaymentsObject $status_transitions
 * @property null|string|\ExpressPayments\Subscription $subscription The subscription that was created or updated from this quote.
 * @property \ExpressPayments\ExpressPaymentsObject $subscription_data
 * @property null|string|\ExpressPayments\SubscriptionSchedule $subscription_schedule The subscription schedule that was created or updated from this quote.
 * @property null|string|\ExpressPayments\TestHelpers\TestClock $test_clock ID of the test clock this quote belongs to.
 * @property \ExpressPayments\ExpressPaymentsObject $total_details
 * @property null|\ExpressPayments\ExpressPaymentsObject $transfer_data The account (if any) the payments will be attributed to for tax reporting, and where funds from each payment will be transferred to for each of the invoices.
 */
class Quote extends ApiResource
{
    const OBJECT_NAME = 'quote';

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;

    const COLLECTION_METHOD_CHARGE_AUTOMATICALLY = 'charge_automatically';
    const COLLECTION_METHOD_SEND_INVOICE = 'send_invoice';

    const STATUS_ACCEPTED = 'accepted';
    const STATUS_CANCELED = 'canceled';
    const STATUS_DRAFT = 'draft';
    const STATUS_OPEN = 'open';

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Quote the accepted quote
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function accept($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/accept';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Quote the canceled quote
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function cancel($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/cancel';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Quote the finalized quote
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function finalizeQuote($params = null, $opts = null)
    {
        $url = $this->instanceUrl() . '/finalize';
        list($response, $opts) = $this->_request('post', $url, $params, $opts);
        $this->refreshFrom($response, $opts);

        return $this;
    }

    /**
     * @param string $id
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Collection<\ExpressPayments\LineItem> list of line items
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function allComputedUpfrontLineItems($id, $params = null, $opts = null)
    {
        $url = static::resourceUrl($id) . '/computed_upfront_line_items';
        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \ExpressPayments\Util\Util::convertToExpressPaymentsObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }

    /**
     * @param string $id
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return \ExpressPayments\Collection<\ExpressPayments\LineItem> list of line items
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public static function allLineItems($id, $params = null, $opts = null)
    {
        $url = static::resourceUrl($id) . '/line_items';
        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \ExpressPayments\Util\Util::convertToExpressPaymentsObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }

    /**
     * @param callable $readBodyChunkCallable
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @return void
     * @throws \ExpressPayments\Exception\ApiErrorException if the request fails
     *
     */
    public function pdf($readBodyChunkCallable, $params = null, $opts = null)
    {
        $opts = \ExpressPayments\Util\RequestOptions::parse($opts);
        if (!isset($opts->apiBase)) {
            $opts->apiBase = \ExpressPayments\ExpressPayments::$apiUploadBase;
        }
        $url = $this->instanceUrl() . '/pdf';
        $this->_requestStream('get', $url, $readBodyChunkCallable, $params, $opts);
    }
}
