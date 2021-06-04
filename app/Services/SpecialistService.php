<?php
/**
 * Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 * Proprietary and confidential.
 */

namespace App\Services;

use libphonenumber\PhoneNumberUtil;

class SpecialistService
{
    /**
     * @var PhoneNumberUtil
     */
    protected $phoneNumberUtil;

    /**
     * SpecialistService constructor.
     */
    public function __construct()
    {
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
    }

    /**
     * Retrieve phone number country code from phone number.
     *
     * @param  string|null  $phoneNumber
     * @param  boolean      $withPlusPrefix
     * @return string
     *
     * @throws \libphonenumber\NumberParseException
     */
    public function getPhoneNumberCountryDialingCode(string $phoneNumber = null, bool $withPlusPrefix = true): string
    {
        if (null === $phoneNumber || '' === $phoneNumber) {
            return null;
        }

        $phoneNumber = $this->phoneNumberUtil->parse($phoneNumber, 'NL');
        return ($withPlusPrefix ? '+' : '') . $phoneNumber->getCountryCode();
    }
}
