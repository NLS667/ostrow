<nav class="navbar sticky-top navbar-expand-lg navbar-dark" id="nav">
    <a class="navbar-brand invisible-lg d-none d-lg-inline" id="to-previous">
      <i class="fas fa-arrow-left fa-fw"></i>
      <span class="d-none d-lg-inline">{{ trans('laravel-filemanager::lfm.nav-back') }}</span>
    </a>
    <a class="navbar-brand d-block d-lg-none" id="show_tree">
      <i class="fas fa-bars fa-fw"></i>
    </a>
    <a class="navbar-brand d-block d-lg-none" id="current_folder"></a>
    <a id="loading" class="navbar-brand"><i class="fas fa-spinner fa-spin"></i></a>
    <div class="ml-auto px-2">
      <a class="navbar-link d-none" id="multi_selection_toggle">
        <i class="fa fa-check-double fa-fw"></i>
        <span class="d-none d-lg-inline">{{ trans('laravel-filemanager::lfm.menu-multiple') }}</span>
      </a>
    </div>
    <a class="navbar-toggler collapsed border-0 px-1 py-2 m-0" data-toggle="collapse" data-target="#nav-buttons">
      <i class="fas fa-cog fa-fw"></i>
    </a>
    <div class="collapse navbar-collapse flex-grow-0" id="nav-buttons">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-display="grid">
            <i class="fas fa-th-large fa-fw"></i>
            <span>{{ trans('laravel-filemanager::lfm.nav-thumbnails') }}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-display="list">
            <i class="fas fa-list-ul fa-fw"></i>
            <span>{{ trans('laravel-filemanager::lfm.nav-list') }}</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sort fa-fw"></i>{{ trans('laravel-filemanager::lfm.nav-sort') }}
          </a>
          <div class="dropdown-menu dropdown-menu-right border-0"></div>
        </li>
      </ul>
    </div>
  </nav>

  <nav class="bg-light fixed-bottom border-top d-none" id="actions">
    <a data-action="open" data-multiple="false"><i class="fas fa-folder-open"></i>{{ trans('laravel-filemanager::lfm.btn-open') }}</a>
    <a data-action="preview" data-multiple="true"><i class="fas fa-images"></i>{{ trans('laravel-filemanager::lfm.menu-view') }}</a>
    <a data-action="use" data-multiple="true"><i class="fas fa-check"></i>{{ trans('laravel-filemanager::lfm.btn-confirm') }}</a>
  </nav>

  <div class="d-flex flex-row">
    <div id="tree"></div>

    <div id="main">
      <div id="alerts"></div>

      <nav aria-label="breadcrumb" class="d-none d-lg-block" id="breadcrumbs">
        <ol class="breadcrumb">
          <li class="breadcrumb-item invisible">Home</li>
        </ol>
      </nav>

      <div id="empty" class="d-none">
        <i class="far fa-folder-open"></i>
        {{ trans('laravel-filemanager::lfm.message-empty') }}
      </div>

      <div id="content"></div>
      <div id="pagination"></div>

      <a id="item-template" class="d-none">
        <div class="square"></div>

        <div class="info">
          <div class="item_name text-truncate"></div>
          <time class="text-muted font-weight-light text-truncate"></time>
        </div>
      </a>
    </div>

    <div id="fab"></div>
  </div>