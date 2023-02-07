@extends ('backend.layouts.pdf', ['activePage' => 'task-management', 'titlePage' => __('Raport Zadania')])

@section('content')
	<!-- Header Section -->
	<div class="container">
		<div class="row">
			<div class="col-xs-2">
				<img class="logo" alt="BIO-KLIM Logo" src="{{ asset('/img/bioclim_logo.jpg') }}" />
			</div>
			<div class="col-xs-9">
				<div class="container green-bg">
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-2">
							<p class="white">Tel. 608 516 632</p>
						</div>
						<div class="col-xs-2 white">
							info@bio-klim.pl
						</div>
						<div class="col-xs-2 white">
							www.bio-klim.pl
						</div>
						<div class="col-xs-3"></div>
					</div>
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-8 white">
							FHU BIO-KLIM Adam Jańcik Prądzyńskiego 30, 63-400 Ostrów Wlkp.
						</div>
						<div class="col-xs-2"></div>
					</div>
				</div>				
			</div>
		</div>
		<!-- Header Section End -->
		<div class="row">
			<div class="col-xs-4">
				Protokół z czynności
			</div>
			<div class="col-xs-3">
				Montaż
			</div>
			<div class="col-xs-4">
				Data
			</div>
		</div>
		<div class="row">
			<div class="col-xs-11">
				<table class="table table-bordered table-sm">
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
			<div class="col-xs-11">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col">Producent</th>
							<th scope="col">Model</th>
							<th scope="col">Nr seryjny</th>
							<th scope="col">Rodzaj czytnika</th>
							<th scope="col">Czynnik karta</th>
							<th scope="col">Czynnik dodany</th>
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
			<div class="col-xs-11">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col" colspan='3'>PRZEPROWADZONE PRACE - Klimatyzacja</th>
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
			<div class="col-xs-11">
				<h4>UWAGI / ZALECENIA / Wykonywanie przeglądów serwisowych zgodnie z kartą gwarancyjną:</h4>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-5">PŁATNOŚĆ: GOTÓWKA PRZELEW</div>
			<div class="col-xs-6">POTWIERDZENIE: PARAGON FAKTURA</div>
		</div>
		<div class="row">
			<div class="col-xs-5">SERWISANT</div>
			<div class="col-xs-6">ZAMAWIAJĄCY</div>
		</div>
	</div>
	<div class="page-break"></div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-11">
				KLIMATYZACJA
			</div>
		</div>
		<div class="row">
			<div class="col-xs-5">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col" colspan='2'>MR. SLIM</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Całkowita długość orurowania (dł. mierzona po rurze cieczowej)</td>
							<td>[m]</td>
						</tr>
						<tr>
							<td>Dodatkowa dodana ilość czynnika chłodniczego </td>
							<td>[kg]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L1-N</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L2-N</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L3-N</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na tłoczeniu (po 30 min. pracy)</td>
							<td>[bar]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na ssaniu (po 30 min. pracy)</td>
							<td>[bar]</td>
						</tr>
						<tr>
							<td>Temperatura tłoczenia sprężarki TH4 (po 30 min. pracy)</td>
							<td>[C]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S1-S2 (napięcie AC)</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S2-S3 (napięcie DC)</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Temperatura w odsługiwanym pomieszczeniu</td>
							<td>[C]</td>
						</tr>
						<tr>
							<td>Temperatura powietrza nawiewnego (po 30 min. pracy)</td>
							<td>[C]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-6">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col" colspan='2'>GREE</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Próba szczelności instalacji freonowej</td>
							<td>[bar]</td>
						</tr>
						<tr>
							<td>Czas trwania próby</td>
							<td>[h]</td>
						</tr>
						<tr>
							<td>Osuszanie próżniowe</td>
							<td>[bar]</td>
						</tr>
						<tr>
							<td>Czas trwania osuszania próżniowego</td>
							<td>[min]</td>
						</tr>
						<tr>
							<td>Temp. nawiewu jed. Wew. grzanie (min/max)</td>
							<td>[C]</td>
						</tr>
						<tr>
							<td>Temp. nawiewu jed. Wew. chłodzenie (min/max)</td>
							<td>[C]</td>
						</tr>
						<tr>
							<td>Temp. w budynku podczas badania nawiewu</td>
							<td>[C]</td>
						</tr>
						<tr>
							<td>Temp. na zewnątrz podczas badania nawiewu</td>
							<td>[C]</td>
						</tr>
						<tr>
							<td>Ilość dodanego czynnika chłodniczego</td>
							<td>[g]</td>
						</tr>
						<tr>
							<td>Długość wyk. instalacji freonowej</td>
							<td>[m]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col" colspan='2'>SERIA M</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Całkowita długość orurowania (dł. mierzona po rurze cieczowej)</td>
							<td>[m]</td>
						</tr>
						<tr>
							<td>Dodatkowa dodana ilość czynnika chłodniczego </td>
							<td>[kg]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L-N</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L i uziemieniem</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S1-S2 (napięcie AC)</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S2-S3 (napięcie DC)</td>
							<td>[V]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na ssaniu (po 30 min. pracy)</td>
							<td>[bar]</td>
						</tr>
						<tr>
							<td>Temperatura w odsługiwanym pomieszczeniu</td>
							<td>[C]</td>
						</tr>
						<tr>
							<td>Temperatura powietrza nawiewnego (po 30 min. pracy)</td>
							<td>[C]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-6">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col" colspan='3'>LOSSNAY</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Napięcie el. Pomiędzy zaciskami L-N</td>
							<td colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Nagrzewnica wstępna</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Kanał wlotowy powietrza nachylony w stronę czerpni</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td>Podłączenie wymiennika kanałowego Mitsubishi GUG</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col" colspan='3'>CITY MULTI</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Ciśnienie w czasie próby ciśnieniowej instalacji chłodniczej</td>
							<td colspan='2'>[bar]</td>
						</tr>
						<tr>
							<td>Dodatkowa dodana ilość czynnika chłodniczego </td>
							<td colspan='2'>[kg]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na ssaniu (po 30 min. pracy)</td>
							<td colspan='2'>[bar]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na tłoczeniu (po 30 min. pracy)</td>
							<td colspan='2'>[bar]</td>
						</tr>
						<tr>
							<td>Temp. na tłoczeniu sprężarki TH4-1-2-4-6 w pozycji ON (SW6-10 OFF)</td>
							<td colspan='2'>[C]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L1-N</td>
							<td colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L2-N</td>
							<td colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L3-N</td>
							<td colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami TB3 (napięcie DC)</td>
							<td colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Przekrój ekranowego przewodu komunikacyjnego</td>
							<td colspan='2'>[mm2]</td>
						</tr>
						<tr>
							<td colspan='3'>Nagranie z narzędzia serwisowego CMS</td>
						</tr>
						<tr>
							<td>Liczba jednostek wewnętrznych podpiętych do układu chłodniczego</td>
							<td colspan='2'>[szt]</td>
						</tr>
						<tr>
							<td>Sterowanie centralne</td>
							<td>TAK</td>
							<td>NIE</td>
						</tr>
						<tr>
							<td colspan='3'>Model sterownika centralnego</td>
						</tr>
						<tr>
							<td>Temperatura w odsługiwanym pomieszczeniu</td>
							<td colspan='2'>[C]</td>
						</tr>
						<tr>
							<td>Temperatura powietrza nawiewnego (po 30 min. pracy)</td>
							<td colspan='2'>[C]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-6"></div>
		</div>
	</div>
@endsection