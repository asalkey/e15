<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmptyArray implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
	   $isEmpty = null;
	   
       foreach($value as $v){
		   if(!isset($v)){
			 $isEmpty = true;   
		   }else{
			 $isEmpty = false;
		   }
	   }
	   
	   return $isempty;
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please, select a choice.';
    }
}
