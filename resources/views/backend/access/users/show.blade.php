@extends ('backend.layouts.app', ['activePage' => 'user-view', 'titlePage' => 'Podgląd Użytkownika'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-info d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Podgląd Użytkownika</h4>

                        <div class="card-tools">
                            @include('backend.access.includes.partials.user-header-buttons')
                        </div><!--box-tools pull-right-->
                    </div><!-- /.box-header -->

                    <div class="card-body">

                        <div role="tabpanel">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">{{ trans('labels.backend.access.users.tabs.titles.overview') }}</a>
                                </li>

                                <li role="presentation">
                                    <a href="#history" aria-controls="history" role="tab" data-toggle="tab">{{ trans('labels.backend.access.users.tabs.titles.history') }}</a>
                                </li>
                            </ul>

                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane mt-30 active" id="overview">
                                    Informacje ogólne
                                </div><!--tab overview profile-->

                                <div role="tabpanel" class="tab-pane mt-30" id="history">
                                    Historia
                                </div><!--tab panel history-->

                            </div><!--tab content-->

                        </div><!--tab panel-->

                    </div><!-- /.box-body -->
                </div><!--box-->
            </div>
        </div>
    </div>
</div>
@endsection