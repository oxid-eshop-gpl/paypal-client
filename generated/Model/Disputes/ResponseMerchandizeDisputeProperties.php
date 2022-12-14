<?php

namespace OxidSolutionCatalysts\PayPalApi\Model\Disputes;

use JsonSerializable;
use OxidSolutionCatalysts\PayPalApi\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * The customer-provided merchandise issue details for the dispute.
 *
 * generated from: response-merchandize_dispute_properties.json
 */
class ResponseMerchandizeDisputeProperties implements JsonSerializable
{
    use BaseModel;

    /** The product has an issue. */
    public const ISSUE_TYPE_PRODUCT = 'PRODUCT';

    /** The service has an issue. */
    public const ISSUE_TYPE_SERVICE = 'SERVICE';

    /**
     * The issue type.
     *
     * use one of constants defined in this class to set the value:
     * @see ISSUE_TYPE_PRODUCT
     * @see ISSUE_TYPE_SERVICE
     * @var string | null
     * minLength: 1
     * maxLength: 255
     */
    public $issue_type;

    /**
     * The product information.
     *
     * @var ResponseProductDetails | null
     */
    public $product_details;

    /**
     * The service details.
     *
     * @var ResponseServiceDetails | null
     */
    public $service_details;

    /**
     * The portable international postal address. Maps to
     * [AddressValidationMetadata](https://github.com/googlei18n/libaddressinput/wiki/AddressValidationMetadata) and
     * HTML 5.1 [Autofilling form controls: the autocomplete
     * attribute](https://www.w3.org/TR/html51/sec-forms.html#autofilling-form-controls-the-autocomplete-attribute).
     *
     * @var AddressPortable | null
     */
    public $return_shipping_address;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        !isset($this->issue_type) || Assert::minLength(
            $this->issue_type,
            1,
            "issue_type in ResponseMerchandizeDisputeProperties must have minlength of 1 $within"
        );
        !isset($this->issue_type) || Assert::maxLength(
            $this->issue_type,
            255,
            "issue_type in ResponseMerchandizeDisputeProperties must have maxlength of 255 $within"
        );
        !isset($this->product_details) || Assert::isInstanceOf(
            $this->product_details,
            ResponseProductDetails::class,
            "product_details in ResponseMerchandizeDisputeProperties must be instance of ResponseProductDetails $within"
        );
        !isset($this->product_details) ||  $this->product_details->validate(ResponseMerchandizeDisputeProperties::class);
        !isset($this->service_details) || Assert::isInstanceOf(
            $this->service_details,
            ResponseServiceDetails::class,
            "service_details in ResponseMerchandizeDisputeProperties must be instance of ResponseServiceDetails $within"
        );
        !isset($this->service_details) ||  $this->service_details->validate(ResponseMerchandizeDisputeProperties::class);
        !isset($this->return_shipping_address) || Assert::isInstanceOf(
            $this->return_shipping_address,
            AddressPortable::class,
            "return_shipping_address in ResponseMerchandizeDisputeProperties must be instance of AddressPortable $within"
        );
        !isset($this->return_shipping_address) ||  $this->return_shipping_address->validate(ResponseMerchandizeDisputeProperties::class);
    }

    private function map(array $data)
    {
        if (isset($data['issue_type'])) {
            $this->issue_type = $data['issue_type'];
        }
        if (isset($data['product_details'])) {
            $this->product_details = new ResponseProductDetails($data['product_details']);
        }
        if (isset($data['service_details'])) {
            $this->service_details = new ResponseServiceDetails($data['service_details']);
        }
        if (isset($data['return_shipping_address'])) {
            $this->return_shipping_address = new AddressPortable($data['return_shipping_address']);
        }
    }

    public function __construct(array $data = null)
    {
        if (isset($data)) {
            $this->map($data);
        }
    }

    public function initProductDetails(): ResponseProductDetails
    {
        return $this->product_details = new ResponseProductDetails();
    }

    public function initServiceDetails(): ResponseServiceDetails
    {
        return $this->service_details = new ResponseServiceDetails();
    }

    public function initReturnShippingAddress(): AddressPortable
    {
        return $this->return_shipping_address = new AddressPortable();
    }
}
