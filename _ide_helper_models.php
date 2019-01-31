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
 * App\Models\BitcoinAddress
 *
 * @property-read \App\Models\BitcoinWallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinAddress query()
 */
	class BitcoinAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BitcoinTransaction
 *
 * @property-read \App\Models\BitcoinWallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinTransaction query()
 */
	class BitcoinTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BitcoinWallet
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BitcoinAddress[] $addresses
 * @property mixed $keys
 * @property mixed $passphrase
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BitcoinTransaction[] $transactions
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinWallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinWallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BitcoinWallet query()
 */
	class BitcoinWallet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DashAddress
 *
 * @property-read \App\Models\DashWallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashAddress query()
 */
	class DashAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DashTransaction
 *
 * @property-read \App\Models\DashWallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashTransaction query()
 */
	class DashTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DashWallet
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DashAddress[] $addresses
 * @property mixed $keys
 * @property mixed $passphrase
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DashTransaction[] $transactions
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashWallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashWallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DashWallet query()
 */
	class DashWallet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmailComponent
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailComponent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailComponent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailComponent query()
 */
	class EmailComponent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LitecoinAddress
 *
 * @property-read \App\Models\LitecoinWallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinAddress query()
 */
	class LitecoinAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LitecoinTransaction
 *
 * @property-read \App\Models\LitecoinWallet $wallet
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinTransaction query()
 */
	class LitecoinTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LitecoinWallet
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LitecoinAddress[] $addresses
 * @property mixed $keys
 * @property mixed $passphrase
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LitecoinTransaction[] $transactions
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinWallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinWallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LitecoinWallet query()
 */
	class LitecoinWallet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ModerationActivity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ModerationActivity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ModerationActivity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ModerationActivity query()
 */
	class ModerationActivity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NotificationSetting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationSetting query()
 */
	class NotificationSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NotificationTemplate
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NotificationTemplate query()
 */
	class NotificationTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Offer
 *
 * @property array $tags
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Offer withToken($flag = true)
 */
	class Offer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentMethod
 *
 * @property-read \App\Models\PaymentMethodCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethod query()
 */
	class PaymentMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentMethodCategory
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PaymentMethod[] $payment_methods
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethodCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethodCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentMethodCategory query()
 */
	class PaymentMethodCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Permission role($roles)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PlatformSetting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlatformSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlatformSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlatformSetting query()
 */
	class PlatformSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile
 *
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile query()
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Spatie\Permission\Models\Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tag query()
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Trade
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TradeChat[] $chats
 * @property-read \App\Models\Offer $offer
 * @property-read \App\Models\User $partner
 * @property-write mixed $confirmed
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trade withToken($flag = true)
 */
	class Trade extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradeChat
 *
 * @property-read \App\Models\Trade $trade
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradeChat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradeChat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradeChat query()
 */
	class TradeChat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BitcoinAddress[] $bitcoin_addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BitcoinTransaction[] $bitcoin_transactions
 * @property-read \App\Models\BitcoinWallet $bitcoin_wallet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DashAddress[] $dash_addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DashTransaction[] $dash_transactions
 * @property-read \App\Models\DashWallet $dash_wallet
 * @property-read mixed $average_rating
 * @property-read mixed $sum_rating
 * @property-read mixed $user_average_rating
 * @property-read mixed $user_sum_rating
 * @property-read bool $verified
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LitecoinAddress[] $litecoin_addresses
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LitecoinTransaction[] $litecoin_transactions
 * @property-read \App\Models\LitecoinWallet $litecoin_wallet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ModerationActivity[] $moderation_activities
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\NotificationSetting[] $notification_setting
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Offer[] $offers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \App\Models\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\willvincent\Rateable\Rating[] $ratings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \App\Models\UserSetting $setting
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Trade[] $trades
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withToken($flag = true)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSetting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSetting query()
 */
	class UserSetting extends \Eloquent {}
}

