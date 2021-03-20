<?php

namespace App\Models;


use Nexmo\Laravel\Facade\Nexmo;
use function PHPUnit\Framework\isNull;

trait UserHelpers
{
    public function getIsSuperAttribute()
    {
        return $this->role->is_super;
    }

    public function getIsAdminOrAboveAttribute()
    {
        return $this->role->is_super ? $this->role->is_super : $this->role->is_admin;
    }

    public function getIsAdminAttribute()
    {
        return $this->role->is_admin;
    }

    public function getIsCompanyAttribute()
    {
        return $this->role->is_company;
    }

    public function getIsDesignerAttribute()
    {
        return $this->role->is_designer;
    }

    public function getIsClientAttribute()
    {
        return $this->role->is_client;
    }

    public function getIsCelebrityAttribute()
    {
        return $this->role->is_celebrity;
    }

    public function scopeCompanies($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_company', true);
        });
    }

    public function scopeCompaniesHasServices($q)
    {
        return $q->companies()->whereHas('services', function ($q) {
            return $q;
        }, '>', 0);
    }

    public function scopeDesigners($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_designer', true);
        });
    }

    public function scopeCelebrities($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_celebrity', true);
        });
    }

    public function scopeSupers($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_super', true);
        });
    }

    public function scopeClients($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_client', true);
        });
    }

    public function scopeAdmins($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_admin', true);
        });
    }

    public function scopeNotAdmins($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_admin', false);
        });
    }

    public function scopeNotClients($q)
    {
        return $q->whereHas('role', function ($q) {
            return $q->where('is_client', false);
        });
    }

    public function scopeHasProducts($q)
    {
        if(env('ESCRAP')) {
            return $q;
        }
        return $q->whereHas('products', function ($q) {
            return $q->active()->hasStock();
        }, '>', 0);
    }

    public function scopeHasServices($q)
    {
        return $q->whereHas('services', function ($q) {
            return $q->active();
        }, '>', 0);
    }

    public function getBgLargeLinkAttribute()
    {
        return asset(env('LARGE') . $this->bg);
    }

    public function getBgMediumLinkAttribute()
    {
        return asset(env('MEDIUM') . $this->bg);
    }

    public function getBgThumbLinkAttribute()
    {
        return asset(env('THUMBNAIL') . $this->bg);
    }

    public function getCountryNameAttribute()
    {
        return $this->country->slug;
    }

    public function getFullMobileAttribute()
    {
        return $this->mobile ? $this->country->calling_code.$this->mobile : null;
    }

    public function getFullWhatsappAttribute()
    {
        return $this->whatsapp ? $this->country->calling_code.$this->whatsapp : null;
    }

    public function getRatingAttribute()
    {
        $elements = Rating::where('member_id', $this->id)->get();
        if (!$elements->isEmpty()) {
            $elementCount = $elements->count() * 100;
            $elementValues = $elements->pluck('value')->sum();
            $rating = (integer)((round($elementValues / $elementCount, 1) * 10) / 2);
            return $rating;
        }
        return 1;
    }

    public function getTotalFansAttribute()
    {
        return $this->fans->count();
    }
}
