<?php

namespace App\Events\ServiceCategory;

use Illuminate\Queue\SerializesModels;

/**
 * Class ServiceCategoryCreated.
 */
class ServiceCategoryCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $serviceCategory;

    /**
     * @param $serviceCategory
     */
    public function __construct($serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
    }
}
