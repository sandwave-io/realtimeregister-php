<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Tests\Domain;

use Exception;
use PHPUnit\Framework\TestCase;
use SandwaveIo\RealtimeRegister\Domain\Account;
use SandwaveIo\RealtimeRegister\Domain\Billable;
use SandwaveIo\RealtimeRegister\Domain\Brand;
use SandwaveIo\RealtimeRegister\Domain\Contact;
use SandwaveIo\RealtimeRegister\Domain\ContactProperty;
use SandwaveIo\RealtimeRegister\Domain\ContactsConstraint;
use SandwaveIo\RealtimeRegister\Domain\Country;
use SandwaveIo\RealtimeRegister\Domain\DomainAvailability;
use SandwaveIo\RealtimeRegister\Domain\DomainContact;
use SandwaveIo\RealtimeRegister\Domain\DomainDetails;
use SandwaveIo\RealtimeRegister\Domain\DomainRegistration;
use SandwaveIo\RealtimeRegister\Domain\DomainSyntax;
use SandwaveIo\RealtimeRegister\Domain\DomainTransferStatus;
use SandwaveIo\RealtimeRegister\Domain\Downtime;
use SandwaveIo\RealtimeRegister\Domain\DsData;
use SandwaveIo\RealtimeRegister\Domain\KeyData;
use SandwaveIo\RealtimeRegister\Domain\LanguageCode;
use SandwaveIo\RealtimeRegister\Domain\LaunchPhase;
use SandwaveIo\RealtimeRegister\Domain\Log;
use SandwaveIo\RealtimeRegister\Domain\Nameservers;
use SandwaveIo\RealtimeRegister\Domain\Notification;
use SandwaveIo\RealtimeRegister\Domain\NotificationPoll;
use SandwaveIo\RealtimeRegister\Domain\Price;
use SandwaveIo\RealtimeRegister\Domain\Process;
use SandwaveIo\RealtimeRegister\Domain\ProcessInfo;
use SandwaveIo\RealtimeRegister\Domain\Provider;
use SandwaveIo\RealtimeRegister\Domain\Registrant;
use SandwaveIo\RealtimeRegister\Domain\Template;
use SandwaveIo\RealtimeRegister\Domain\TemplatePreview;
use SandwaveIo\RealtimeRegister\Domain\TLDInfo;
use SandwaveIo\RealtimeRegister\Domain\Zone;
use SandwaveIo\RealtimeRegister\Exceptions\InvalidArgumentException;
use TypeError;
use ValueError;

/**
 * This TestCase is used to test all single Domain Objects.
 * If you want to test Collections, use the DomainCollectionTest instead.
 */
class DomainObjectTest extends TestCase
{
    public static function parserDataSet(): array
    {
        /**
         * This data provider has three fields, the last one of which is optional.
         *  - Class: The data class that is tested.
         *  - Data: A data array, most commonly by including a php file.
         *  - Exception: (nullable), the exception to expect. If null: no exception should occur.
         */
        return [
            'valid account' => [
                Account::class,
                include __DIR__ . '/data/account_valid.php',
            ],
            'invalid account (balance)' => [
                Account::class,
                include __DIR__ . '/data/account_invalid_balance.php',
                TypeError::class,
            ],
            'valid billable' => [
                Billable::class,
                include __DIR__ . '/data/billable_valid.php',
            ],
            'invalid billable (action)' => [
                Billable::class,
                include __DIR__ . '/data/billable_invalid_action.php',
                ValueError::class,
            ],
            'valid contact (all fields)' => [
                Contact::class,
                include __DIR__ . '/data/contact_valid.php',
            ],
            'valid contact (only required fields)' => [
                Contact::class,
                include __DIR__ . '/data/contact_valid_only_required.php',
            ],
            'invalid contact (name)' => [
                Contact::class,
                include __DIR__ . '/data/contact_invalid_name.php',
                TypeError::class,
            ],
            'valid country (all fields)' => [
                Country::class,
                include __DIR__ . '/data/country_valid.php',
            ],
            'valid country (only required fields)' => [
                Country::class,
                include __DIR__ . '/data/country_valid_only_required.php',
            ],
            'invalid country (name)' => [
                Country::class,
                include __DIR__ . '/data/country_invalid_code.php',
                TypeError::class,
            ],
            'valid domain availability (all fields)' => [
                DomainAvailability::class,
                include __DIR__ . '/data/domain_availability_valid.php',
            ],
            'valid domain availability (only required)' => [
                DomainAvailability::class,
                include __DIR__ . '/data/domain_availability_only_required.php',
            ],
            'invalid domain availability (name)' => [
                DomainAvailability::class,
                include __DIR__ . '/data/domain_availability_invalid_price.php',
                TypeError::class,
            ],
            'valid domain contact (all fields)' => [
                DomainContact::class,
                include __DIR__ . '/data/domain_contact_valid.php',
            ],
            'invalid domain contact (handle)' => [
                DomainContact::class,
                include __DIR__ . '/data/domain_contact_invalid_handle.php',
                TypeError::class,
            ],
            'invalid domain contact (role)' => [
                DomainContact::class,
                include __DIR__ . '/data/domain_contact_invalid_role.php',
                InvalidArgumentException::class,
            ],
            'valid domain details (all fields)' => [
                DomainDetails::class,
                include __DIR__ . '/data/domain_details_valid.php',
            ],
            'valid domain details (only required)' => [
                DomainDetails::class,
                include __DIR__ . '/data/domain_details_valid_only_required.php',
            ],
            'invalid domain details' => [
                DomainDetails::class,
                include __DIR__ . '/data/domain_details_invalid.php',
                InvalidArgumentException::class,
            ],
            'valid domain registration (all fields)' => [
                DomainRegistration::class,
                include __DIR__ . '/data/domain_registration_valid.php',
            ],
            'invalid domain registration (name)' => [
                DomainRegistration::class,
                include __DIR__ . '/data/domain_registration_invalid_name.php',
                TypeError::class,
            ],
            'invalid domain registration (expire)' => [
                DomainRegistration::class,
                include __DIR__ . '/data/domain_registration_invalid_date.php',
                Exception::class,
            ],
            'valid ds data (all fields)' => [
                DsData::class,
                include __DIR__ . '/data/ds_data_valid.php',
            ],
            'invalid ds data algorithm (all fields)' => [
                DsData::class,
                include __DIR__ . '/data/ds_data_invalid_algorithm.php',
                InvalidArgumentException::class,
            ],
            'invalid ds data digest (all fields)' => [
                DsData::class,
                include __DIR__ . '/data/ds_data_invalid_digest.php',
                InvalidArgumentException::class,
            ],
            'valid key data (all fields)' => [
                KeyData::class,
                include __DIR__ . '/data/key_data_valid.php',
            ],
            'invalid key data flags (all fields)' => [
                KeyData::class,
                include __DIR__ . '/data/key_data_invalid_flag.php',
                InvalidArgumentException::class,
            ],
            'invalid key data protocol (all fields)' => [
                KeyData::class,
                include __DIR__ . '/data/key_data_invalid_protocol.php',
                InvalidArgumentException::class,
            ],
            'invalid key (all fields)' => [
                KeyData::class,
                include __DIR__ . '/data/key_data_invalid_key.php',
                InvalidArgumentException::class,
            ],
            'valid price (all fields)' => [
                Price::class,
                include __DIR__ . '/data/price_valid.php',
            ],
            'valid zone (all fields)' => [
                Zone::class,
                include __DIR__ . '/data/zone_valid.php',
            ],
            'valid contact property' => [
                ContactProperty::class,
                include __DIR__ . '/data/contact_property_valid.php',
            ],
            'valid contact constraint' => [
                ContactsConstraint::class,
                include __DIR__ . '/data/contacts_constraint.php',
            ],
            'valid domain syntax' => [
                DomainSyntax::class,
                include __DIR__ . '/data/domain_syntax.php',
            ],
            'valid language code (all fields)' => [
                LanguageCode::class,
                include __DIR__ . '/data/language_code_allowed_characters.php',
            ],
            'valid language code (required only)' => [
                LanguageCode::class,
                include __DIR__ . '/data/language_code_required.php',
            ],
            'valid launch phase' => [
                LaunchPhase::class,
                include __DIR__ . '/data/launch_phase.php',
            ],
            'valid nameservers' => [
                Nameservers::class,
                include __DIR__ . '/data/nameservers.php',
            ],
            'valid registrant' => [
                Registrant::class,
                include __DIR__ . '/data/registrant.php',
            ],
            'valid tld info' => [
                TLDInfo::class,
                include __DIR__ . '/data/tldinfo.php',
            ],
            'valid log' => [
                Log::class,
                include __DIR__ . '/data/log.php',
            ],
            'domain transfer status' => [
                DomainTransferStatus::class,
                include __DIR__ . '/data/domain_transfer_status.php',
            ],
            'valid notification (all fields)' => [
                Notification::class,
                include __DIR__ . '/data/notification_valid.php',
            ],
            'valid notification (only required)' => [
                Notification::class,
                include __DIR__ . '/data/notification_valid_only_required.php',
            ],
            'invalid notification (id)' => [
                Notification::class,
                include __DIR__ . '/data/notification_invalid_id.php',
                TypeError::class,
            ],
            'valid notification poll (all fields)' => [
                NotificationPoll::class,
                include __DIR__ . '/data/notification_poll_valid.php',
            ],
            'valid notification poll (only required)' => [
                NotificationPoll::class,
                include __DIR__ . '/data/notification_poll_valid_only_required.php',
            ],
            'invalid notification poll (count)' => [
                NotificationPoll::class,
                include __DIR__ . '/data/notification_poll_invalid_count.php',
                TypeError::class,
            ],
            'valid process (all fields)' => [
                Process::class,
                include __DIR__ . '/data/process_valid.php',
            ],
            'valid process (only required)' => [
                Process::class,
                include __DIR__ . '/data/process_valid_only_required.php',
            ],
            'valid process (status)' => [
                Process::class,
                include __DIR__ . '/data/process_invalid_status.php',
                InvalidArgumentException::class,
            ],
            'valid process info' => [
                ProcessInfo::class,
                include __DIR__ . '/data/process_info_valid.php',
            ],
            'valid provider (all fields)' => [
                Provider::class,
                include __DIR__ . '/data/provider_valid.php',
            ],
            'valid provider (only required)' => [
                Provider::class,
                include __DIR__ . '/data/provider_valid_only_required.php',
            ],
            'invalid provider (name)' => [
                Provider::class,
                include __DIR__ . '/data/provider_invalid_name.php',
                TypeError::class,
            ],
            'valid downtime (all fields)' => [
                Downtime::class,
                include __DIR__ . '/data/downtime_valid.php',
            ],
            'valid downtime (only required)' => [
                Downtime::class,
                include __DIR__ . '/data/downtime_valid_only_required.php',
            ],
            'invalid downtime (id)' => [
                Downtime::class,
                include __DIR__ . '/data/downtime_invalid_id.php',
                TypeError::class,
            ],
            'invalid downtime (start date)' => [
                Downtime::class,
                include __DIR__ . '/data/downtime_invalid_start_date.php',
                TypeError::class,
            ],
            'invalid downtime (end date)' => [
                Downtime::class,
                include __DIR__ . '/data/downtime_invalid_end_date.php',
                TypeError::class,
            ],
            'invalid downtime (provider)' => [
                Downtime::class,
                include __DIR__ . '/data/downtime_invalid_provider.php',
                TypeError::class,
            ],
            'valid brand (all fields)' => [
                Brand::class,
                include __DIR__ . '/data/brand_valid.php',
            ],
            'valid brand (only required)' => [
                Brand::class,
                include __DIR__ . '/data/brand_valid_only_required.php',
            ],
            'invalid brand (name)' => [
                Brand::class,
                include __DIR__ . '/data/brand_invalid_name.php',
                TypeError::class,
            ],
            'valid template (all fields)' => [
                Template::class,
                include __DIR__ . '/data/template_valid.php',
            ],
            'valid template (only required)' => [
                Template::class,
                include __DIR__ . '/data/template_valid_only_required.php',
            ],
            'invalid template (name)' => [
                Template::class,
                include __DIR__ . '/data/template_invalid_name.php',
                InvalidArgumentException::class,
            ],
            'valid template preview' => [
                TemplatePreview::class,
                include __DIR__ . '/data/template_preview_valid.php',
            ],
        ];
    }

    /** @dataProvider parserDataSet */
    public function test_from_and_to_array(string $class, array $data, ?string $exception = null): void
    {
        // In case of invalid data.
        if ($exception) {
            self::expectException($exception);
        }
        // Object from array
        $object = call_user_func($class . '::fromArray', $data);
        self::assertSame($class, get_class($object), "{$class}::fromArray(array \$json) gave an unexpected result.");

        // Object to array
        $array = $object->toArray();
        self::assertSame($data, $array, "{$class}::toArray() gave an unexpected result.");
    }
}
