<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown">@lang('menus.backend.access.export')
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li id="copyButton" class="dropdown-item"><a href="#"><i class="fas fa-copy"></i> @lang('menus.backend.access.copy')</a></li>
    <li id="csvButton" class="dropdown-item"><a href="#"><i class="far fa-file-text"></i> CSV</a></li>
    <li id="excelButton" class="dropdown-item"><a href="#"><i class="far fa-file-excel"></i> Excel</a></li>
    <li id="pdfButton" class="dropdown-item"><a href="#"><i class="far fa-file-pdf"></i> PDF</a></li>
    <li id="printButton" class="dropdown-item"><a href="#"><i class="fas fa-print"></i> @lang('menus.backend.access.print')</a></li>
  </ul>
</div>
