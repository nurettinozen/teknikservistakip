<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Modelling
 *
 * @property int $id
 * @property string $model_name
 * @property int $brand_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modelling whereUpdatedAt($value)
 */
	class Modelling extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Customer
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $phone
 * @property string|null $gsm
 * @property string|null $address
 * @property string|null $identity_number
 * @property int $type
 * @property string|null $company_name
 * @property string|null $tax_number
 * @property string|null $tax_authority
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereGsm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereIdentityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereTaxAuthority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereTaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Customer whereUpdatedAt($value)
 */
	class Customer extends \Eloquent {}
}

namespace App{
/**
 * App\Component
 *
 * @property int $id
 * @property int $brand_id
 * @property int $model_id
 * @property string $component_name
 * @property string $stock
 * @property int $get_price
 * @property int $sell_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereComponentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereGetPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereSellPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Component whereUpdatedAt($value)
 */
	class Component extends \Eloquent {}
}

namespace App{
/**
 * App\Device
 *
 * @property int $id
 * @property int $brand_id
 * @property int $model_id
 * @property int $customer_id
 * @property string $pre_detection
 * @property string $customer_request
 * @property string $repair_description
 * @property string|null $delivered_person
 * @property string|null $delivery_person
 * @property string $serial_number
 * @property string $barcode
 * @property int $guarantee
 * @property string|null $guarantee_start
 * @property string|null $guarantee_finish
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereBarcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereCustomerRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereDeliveredPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereDeliveryPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereGuarantee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereGuaranteeFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereGuaranteeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device wherePreDetection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereRepairDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereUpdatedAt($value)
 */
	class Device extends \Eloquent {}
}

namespace App{
/**
 * App\Brand
 *
 * @property int $id
 * @property string $brand_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Brand whereUpdatedAt($value)
 */
	class Brand extends \Eloquent {}
}

