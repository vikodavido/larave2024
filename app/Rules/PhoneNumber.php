<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match('/^\+?(\d{1,4})\)?[-. ]?(\d{1,4})[-. ]?(\d{1,4})[-. ]?(\d{1,4})$/', $value)) {
            $fail("The $attribute is not a valid phone number.");
        }
    }
}
