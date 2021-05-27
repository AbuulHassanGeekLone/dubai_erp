<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AccountManagement
 *
 * @property int $id
 * @property int $account_type
 * @property string $account_name
 * @property string|null $description
 * @property string|null $opening_balance
 * @property int|null $status
 * @property string $ordered_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereOpeningBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereOrderedUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountManagement whereUpdatedAt($value)
 */
	class AccountManagement extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountModel
 *
 * @property int $id
 * @property string $name
 * @property int $model_type
 * @property string $model_type_name
 * @method static \Illuminate\Database\Eloquent\Builder|AccountModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountModel whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountModel whereModelTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountModel whereName($value)
 */
	class AccountModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountRegister
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AccountRegister newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountRegister newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountRegister query()
 */
	class AccountRegister extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AccountType
 *
 * @property int $id
 * @property string $name
 * @property int $transection_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereTransectionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereUpdatedAt($value)
 */
	class AccountType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @property int $id
 * @property string $name
 * @property int $region_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property string|null $opening_balance
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $rtn
 * @property string|null $address
 * @property int $region_id
 * @property int $city_id
 * @property string $ordered_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereOpeningBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereOrderedUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereRtn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expense
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Expense query()
 */
	class Expense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Journal
 *
 * @property int $id
 * @property string $journal_uuid
 * @property int $transection_type_id recievable,payable,general
 * @property int|null $s_p_am_id sale,purchase,account manager id
 * @property int $s_p_am_type sale,purchase,account manager type
 * @property int $account_id vendor name,customer name
 * @property int $account_type_id
 * @property int|null $advance_reverse
 * @property string|null $amount
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereAccountTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereAdvanceReverse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereJournalUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereSPAmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereSPAmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereTransectionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedAt($value)
 */
	class Journal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderDetail
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail query()
 */
	class OrderDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string|null $picture
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Purchase
 *
 * @property int $id
 * @property string|null $pay_date
 * @property int $vendor_id
 * @property int $status
 * @property string|null $type
 * @property string|null $paid_amount
 * @property string|null $total_amount
 * @property string $ordered_uuid
 * @property string|null $discount
 * @property string|null $extra_discount
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereExtraDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereOrderedUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase wherePayDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Purchase whereVendorId($value)
 */
	class Purchase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PurchaseDetail
 *
 * @property int $id
 * @property int $purchase_id
 * @property int $product_id
 * @property int $quantity
 * @property string $unit_price
 * @property string $sale_price
 * @property string $discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PurchaseDetail whereUpdatedAt($value)
 */
	class PurchaseDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Region
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Region whereUpdatedAt($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Sale
 *
 * @property int $id
 * @property string|null $pay_date
 * @property int $customer_id
 * @property int $status
 * @property string|null $type
 * @property string|null $paid_amount
 * @property string $total_amount
 * @property string $ordered_uuid
 * @property string $ordered_uuid_cost
 * @property string|null $discount
 * @property string|null $extra_discount
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereExtraDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereOrderedUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereOrderedUuidCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale wherePayDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 */
	class Sale extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SaleDetail
 *
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property int $quantity
 * @property string $unit_price
 * @property string|null $discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleDetail whereUpdatedAt($value)
 */
	class SaleDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $state
 * @property int|null $role
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property string $name
 * @property string|null $opening_balance
 * @property string $mobile
 * @property string|null $email
 * @property string $rtn
 * @property int $region_id
 * @property int $city_id
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereOpeningBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereRegionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereRtn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUpdatedAt($value)
 */
	class Vendor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\transectionHistory
 *
 * @property int $id
 * @property int $number
 * @property int $transection_type_id
 * @property int $account_id
 * @property string|null $description
 * @property string $amount
 * @property string $paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereTransectionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionHistory whereUpdatedAt($value)
 */
	class transectionHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\transectionType
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|transectionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|transectionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|transectionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|transectionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|transectionType whereUpdatedAt($value)
 */
	class transectionType extends \Eloquent {}
}

