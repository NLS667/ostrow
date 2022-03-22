@extends ('backend.layouts.app', ['activePage' => 'user-view', 'titlePage' => 'Zarządzanie Użytkownikami'])

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
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-pills-warning" role="tablist" style="margin-top:20px;">
                            <li role="presentation" class="nav-item">
                                <a class="nav-link active show" href="#overview" aria-controls="overview" role="tablist" data-toggle="tab">Informacje Ogólne</a>
                            </li>

                            <li role="presentation" class="nav-item">
                                <a class="nav-link" href="#history" aria-controls="history" role="tablist" data-toggle="tab">Historia</a>
                            </li>
                        </ul>

                        <div class="tab-content tab-space">

                            <div role="tabpanel" class="tab-pane active show" id="overview">
                                @include('backend.access.show.tabs.overview')
                            </div><!--tab overview profile-->

                            <div role="tabpanel" class="tab-pane" id="history">
                                @include('backend.access.show.tabs.history')
                            </div><!--tab panel history-->

                        </div><!--tab content-->
                    </div><!-- /.box-body -->
                </div><!--box-->
            </div>
        </div>
    </div>
</div>
@endsection