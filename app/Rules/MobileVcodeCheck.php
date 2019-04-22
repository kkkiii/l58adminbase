<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Redis ;
class MobileVcodeCheck implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $mobile;
    public function __construct($mobile)
    {
        $this->mobile = $mobile ;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rest =  Redis::get('mobile.reg:' . $this->mobile);

        return $rest == $value ;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '验证码不对';
    }
}
