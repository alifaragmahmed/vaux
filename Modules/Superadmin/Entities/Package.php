<?php

namespace Modules\Superadmin\Entities;

use App\BusinessType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'custom_permissions' => 'array',
    ];

    public $appends = ['image_url'];

    public function getImageUrlAttribute() {
        $this->interval == 'days'? $this->interval = 'month' : '';
        return $this->image ? url($this->image) : url('images/' . $this->interval . "-package.png");
    }
    
    /**
     * Scope a query to only include active packages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Returns the list of active pakages
     *
     * @return object
     */
    public static function listPackages($exlude_private = false)
    {
        $packages = Package::active()
                        ->orderby('sort_order');

        if ($exlude_private) {
            $packages->notPrivate();
        }

        return $packages->get();
    }

    /**
     * Scope a query to exclude private packages.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPrivate($query)
    {
        return $query->where('is_private', 0);
    }


    public function businessType() {
        return $this->belongsTo(BusinessType::class, "business_type_id");
    }
}
