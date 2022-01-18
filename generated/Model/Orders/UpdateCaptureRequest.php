<?php

namespace OxidSolutionCatalysts\PayPalApi\Model\Orders;

use JsonSerializable;
use OxidSolutionCatalysts\PayPalApi\Model\BaseModel;
use Webmozart\Assert\Assert;

/**
 * A captured payment.
 *
 * generated from: model-update_capture_request.json
 */
class UpdateCaptureRequest implements JsonSerializable
{
    use BaseModel;

    /** The funds for this captured payment were credited to the payee's PayPal account. */
    public const STATUS_COMPLETED = 'COMPLETED';

    /** The funds could not be captured. */
    public const STATUS_DECLINED = 'DECLINED';

    /** An amount less than this captured payment's amount was partially refunded to the payer. */
    public const STATUS_PARTIALLY_REFUNDED = 'PARTIALLY_REFUNDED';

    /** The funds for this captured payment was not yet credited to the payee's PayPal account. For more information, see <code>status.details</code> */
    public const STATUS_PENDING = 'PENDING';

    /** An amount greater than or equal to this captured payment's amount was refunded to the payer. */
    public const STATUS_REFUNDED = 'REFUNDED';

    /**
     * The transaction ID for the captured payment.
     *
     * @var string
     * minLength: 1
     * maxLength: 20
     */
    public $id;

    /**
     * The status of the captured payment.
     *
     * use one of constants defined in this class to set the value:
     * @see STATUS_COMPLETED
     * @see STATUS_DECLINED
     * @see STATUS_PARTIALLY_REFUNDED
     * @see STATUS_PENDING
     * @see STATUS_REFUNDED
     * @var string
     * minLength: 1
     * maxLength: 127
     */
    public $status;

    /**
     * The details of the captured payment status.
     *
     * @var CaptureStatusDetails | null
     */
    public $status_details;

    public function validate($from = null)
    {
        $within = isset($from) ? "within $from" : "";
        Assert::notNull($this->id, "id in UpdateCaptureRequest must not be NULL $within");
        Assert::minLength(
            $this->id,
            1,
            "id in UpdateCaptureRequest must have minlength of 1 $within"
        );
        Assert::maxLength(
            $this->id,
            20,
            "id in UpdateCaptureRequest must have maxlength of 20 $within"
        );
        Assert::notNull($this->status, "status in UpdateCaptureRequest must not be NULL $within");
        Assert::minLength(
            $this->status,
            1,
            "status in UpdateCaptureRequest must have minlength of 1 $within"
        );
        Assert::maxLength(
            $this->status,
            127,
            "status in UpdateCaptureRequest must have maxlength of 127 $within"
        );
        !isset($this->status_details) || Assert::isInstanceOf(
            $this->status_details,
            CaptureStatusDetails::class,
            "status_details in UpdateCaptureRequest must be instance of CaptureStatusDetails $within"
        );
        !isset($this->status_details) ||  $this->status_details->validate(UpdateCaptureRequest::class);
    }

    private function map(array $data)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        if (isset($data['status'])) {
            $this->status = $data['status'];
        }
        if (isset($data['status_details'])) {
            $this->status_details = new CaptureStatusDetails($data['status_details']);
        }
    }

    public function __construct(array $data = null)
    {
        if (isset($data)) {
            $this->map($data);
        }
    }

    public function initStatusDetails(): CaptureStatusDetails
    {
        return $this->status_details = new CaptureStatusDetails();
    }
}
