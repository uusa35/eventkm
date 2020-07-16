<?php
/**
 * Created by PhpStorm.
 * User: usama
 * Date: 2019-03-11
 * Time: 14:00
 */

namespace App\Models;


use Carbon\Carbon;

trait ServiceHelpers
{
    public function scopeServeCountries($q)
    {
        return $q->whereHas('user', function ($q) {
            $q->where(['country_id' => getCurrentCountrySessionId()]);
        });

    }

    public function scopeHasValidTimings($q)
    {
        if($this->start_date && $this->end_date) {
            return $q->whereHas('timings', function ($q) {
                return $q->active()->workingDays();
            },'>',0);
        }
    }
}
