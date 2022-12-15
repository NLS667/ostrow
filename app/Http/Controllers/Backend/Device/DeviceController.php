<?php

namespace App\Http\Controllers\Backend\Device;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Model\ManageModelRequest;
use App\Http\Responses\ViewResponse;

/**
 * Class DeviceController.
 */
class DeviceController extends Controller
{
    
    /**
     * @param \App\Http\Requests\Backend\Device\ManageDeviceRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageDeviceRequest $request)
    {
        return new ViewResponse('backend.device.index');
    }
}
