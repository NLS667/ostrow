@extends('frontend.layouts.app')

@section('content')
<div class="page-header page-header-xs" data-parallax="true" style="background-image: url('img/fabio-mangione.jpg');">
    <div class="filter"></div>
</div>
<div class="section profile-content">
    <div class="container">
        <div class="owner">
            <div class="avatar">
              <img src="../assets/img/faces/joe-gardner-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
            </div>
            <div class="name">
              <h4 class="title">{{$logged_in_user->username}}
                <br />
              </h4>
              <h6 class="description">{{$logged_in_user->role}}</h6>
            </div>
        </div>
        <br/>
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">{{ trans('navs.frontend.user.profile') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#edit" role="tab">{{ trans('labels.frontend.user.profile.update_information') }}</a>
                    </li>
                    @if ($logged_in_user->canChangePassword())
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#password" role="tab">{{ trans('labels.frontend.user.passwords.change') }}</a>
                    </li>
                    @endif
                </ul>
                <!-- Tab panes -->
                <div class="tab-content following">
                    <div role="tabpanel" class="tab-pane mt-30 active" id="profile">
                        @include('frontend.user.account.tabs.profile')
                    </div><!--tab panel profile-->

                    <div role="tabpanel" class="tab-pane mt-30" id="edit">
                        @include('frontend.user.account.tabs.edit')
                    </div><!--tab panel profile-->

                    @if ($logged_in_user->canChangePassword())
                    <div role="tabpanel" class="tab-pane mt-30" id="password">
                        @include('frontend.user.account.tabs.change-password')
                    </div><!--tab panel change password-->
                    @endif

                    @include('frontend.user.account.upload-photo-modal')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {

        // To Use Select2
        Backend.Select2.init();

        if($.session.get("tab") == "edit")
        {
            $("#li-password").removeClass("active");
            $("#li-profile").removeClass("active");
            $("#li-edit").addClass("active");

            $("#profile").removeClass("active");
            $("#password").removeClass("active");
            $("#edit").addClass("active");
        }
        else if($.session.get("tab") == "password")
        {
            $("#li-password").addClass("active");
            $("#li-profile").removeClass("active");
            $("#li-edit").removeClass("active");

            $("#profile").removeClass("active");
            $("#password").addClass("active");
            $("#edit").removeClass("active");
        }

        $(".tabs").click(function() {
            var tab = $(this).attr("aria-controls");
            $.session.set("tab", tab);
        });
    });
</script>
@endsection