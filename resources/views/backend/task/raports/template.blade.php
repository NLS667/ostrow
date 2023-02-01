@extends ('backend.layouts.pdf', ['activePage' => 'task-management', 'titlePage' => __('Raport Zadania')])

@section('content')
<div class="content">
	<div class="container">
		<!-- Header Section -->
		<div class="row">
			<div class="col-md-3">
				<img class="logo" alt="BIO-KLIM Logo" src="{{ asset('/img/bioclim_logo.jpg') }}" style="width:100%"/>
			</div>
			<div class="col-md-9">
				<div class="row green-bg">
					<div class="col-md-2"></div>
					<div class="col-md-2">
						Tel. 608 516 632
					</div>
					<div class="col-md-2">
						info@bio-klim.pl
					</div>
					<div class="col-md-2">
						www.bio-klim.pl
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						FHU BIO-KLIM Adam Jańcik Prądzyńskiego 30, 63-400 Ostrów Wlkp.
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
		<!-- Header Section End -->
		<div class="row">
			<div class="col-md-4">
				Protokół z czynności
			</div>
			<div class="col-md-4">
				Montaż
			</div>
			<div class="col-md-4">
				Data
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table>
					<tbody>
						<tr>
							<td>Imię i Nazwisko/Firma</td>
							<td></td>
						</tr>
						<tr>
							<td>Adres (dane do faktury)</td>
							<td></td>
						</tr>
						<tr>
							<td>Tel. kontaktowy</td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table>
					<thead>
						<tr>
							<td>Producent</td>
							<td>Model</td>
							<td>Nr seryjny</td>
							<td>Rodzaj czytnika</td>
							<td>Czynnik karta</td>
							<td>Czynnik dodany</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table>
					<thead>
						<tr colspan='3'>
							<td>PRZEPROWADZONE PRACE - Klimatyzacja</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Wymiana / czyszczenie filtrów powietrza</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie filtrów wody technologicznej</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie parownika</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Odgrzybianie</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Sprawdzanie szczelności inst. odprowadzenia skroplin</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie skraplacza</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Kontrola temperatury nawiewnego powietrza</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Kontrola szczelności instalacji</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>UWAGI / ZALECENIA / Wykonywanie przeglądów serwisowych zgodnie z kartą gwarancyjną:</h4>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">PŁATNOŚĆ: GOTÓWKA PRZELEW</div>
			<div class="col-md-6">POTWIERDZENIE: PARAGON FAKTURA</div>
		</div>
		<div class="row">
			<div class="col-md-6">SERWISANT</div>
			<div class="col-md-6">ZAMAWIAJĄCY</div>
		</div>
	</div>
	<div class="page-break"></div>
	<div class="container">

	</div>
</div>
@endsection