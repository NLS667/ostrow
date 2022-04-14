<?php

namespace App\Events\ServiceCategory;

use App\Models\ServiceCategory\ServiceCategory;
use Illuminate\Queue\SerializesModels;

/**
 * Class ServiceCategoryUpdated.
 */
class ServiceCategoryUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $serviceCategory;

    /**
     * @param $serviceCategory
     */
    public function __construct(ServiceCategory $serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
    }
}
