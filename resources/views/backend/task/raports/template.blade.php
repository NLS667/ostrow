@extends ('backend.layouts.pdf', ['activePage' => 'task-management', 'titlePage' => __('Raport Zadania')])

@section('content')
<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-3">
				<img class="logo" alt="BIO-KLIM Logo" src="{{ asset('/img/bioclim_logo.jpg') }}" style="width:100%"/>
			</div>
			<div class="col-9">
				<div class="row green-bg">
					<div class="col-md-4">
						Tel. 608 516 632
					</div>
					<div class="col-md-4">
						info@bio-klim.pl
					</div>
					<div class="col-md-4">
						www.bio-klim.pl
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						FHU BIO-KLIM Adam Jańcik Prądzyńskiego 30, 63-400 Ostrów Wlkp.
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			</div>
		</div>
	</div>
</div>
@endsection