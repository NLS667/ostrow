<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\User\ChangePasswordRequest;
use App\Repositories\Backend\Access\User\UserRepository;

/**
 * Class ChangePasswordController.
 */
class ChangePasswordController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ChangePasswordController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param ChangePasswordRequest $request
     *
     * @return mixed
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $this->user->changePassword($request->all());

        return redirect()->route('backend.user.account')->withFlashSuccess(trans('strings.backend.user.password_updated'));
    }
}
