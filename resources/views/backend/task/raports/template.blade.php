@extends ('backend.layouts.pdf', ['activePage' => 'task-management', 'titlePage' => __('Raport Zadania')])

@section('content')
	<!-- Header Section -->
	<div class="container">
		<table class="table-borderless mb-10">
			<tbody>
				<tr class="green-bg">
					<td class="td-3" rowspan="3" style="padding-right: 10px;">
						<img class="border" src="{{ asset('/img/bioclim_logo.jpg') }}" style="width: 100%;"/>
					</td>
					<td class="td-1"></td>
					<td class="td-2 text-right">
						Tel. 608 516 632
					</td>
					<td class="td-2 text-center">
						info@bio-klim.pl
					</td>
					<td class="td-2 text-left">
						www.bio-klim.pl
					</td>
					<td class="td-1"></td>
				</tr>
				<tr>
					<td class="td-1"></td>
				    <td  class="td-6 text-center" colspan="3">
				    	FHU BIO-KLIM Adam Jańcik Prądzyńskiego 30, 63-400 Ostrów Wlkp.
				    </td>
				    <td class="td-1"></td>
				</tr>
				<tr>
					<td class="td-8" colspan="5"></td>
				</tr>
			</tbody>
		</table>
		<!-- Header Section End -->
		<div class="row">
			<div class="col-xs-6">
				<strong style="font-size: 12px;">PROTOKÓŁ Z CZYNNOŚCI:&nbsp;&nbsp;&nbsp;&nbsp;{{ $task->type }} </strong>
			</div>
			<div class="col-xs-6 text-right">
				<strong style="font-size: 12px;">DATA: ........................................</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td class="td-3 gray-bg"><strong>IMIĘ I NAZWISKO<br/>FIRMA</strong></td>
							<td class="td-9">{{ $client->name }}</td>
						</tr>
						<tr>
							<td class="gray-bg"><strong>ADRES<br/>DANE DO FAKTURY</strong></td>
							<td>{!! $client->address !!}</td>
						</tr>
						<tr>
							<td class="gray-bg"><strong>TEL. KONTAKTOWY</strong></td>
							<td>{{ $client->phones }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th scope="col" class="td-3 gray-bg text-center align-middle">Producent</th>
							<th scope="col" class="td-2 gray-bg text-center align-middle">Model</th>
							<th scope="col" class="td-4 gray-bg text-center align-middle">Nr seryjny</th>
							<th scope="col" class="td-1 gray-bg text-center">Rodzaj czytnika</th>
							<th scope="col" class="td-1 gray-bg text-center">Czynnik karta</th>
							<th scope="col" class="td-1 gray-bg text-center">Czynnik dodany</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th class="gray-bg text-center" scope="col" colspan='3'><strong>PRZEPROWADZONE PRACE - Klimatyzacja</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td-10">Wymiana / czyszczenie filtrów powietrza</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie filtrów wody technologicznej</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie parownika</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
						<tr>
							<td>Odgrzybianie</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
						<tr>
							<td>Sprawdzanie szczelności inst. odprowadzenia skroplin</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie skraplacza</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
						<tr>
							<td>Kontrola temperatury nawiewnego powietrza</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
						<tr>
							<td>Kontrola szczelności instalacji</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<p style="font-size:10px;"><strong>UWAGI / ZALECENIA / Wykonywanie przeglądów serwisowych zgodnie z kartą gwarancyjną:</strong></p>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">PŁATNOŚĆ: GOTÓWKA PRZELEW</div>
			<div class="col-xs-6">POTWIERDZENIE: PARAGON FAKTURA</div>
		</div>
		<div class="row">
			<div class="col-xs-6">SERWISANT</div>
			<div class="col-xs-6">ZAMAWIAJĄCY</div>
		</div>
	</div>
	<div class="page-break"></div>
	<div class="container">
		<div class="row" style="margin-bottom:10px;">
			<div class="col-xs-12 gray-bg">
				<strong>KLIMATYZACJA</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-7">
				<table class="table table-bordered table-sm" style="padding-right: 10px;">
					<thead class="thead-light">
						<tr>
							<th class="gray-bg" scope="col" colspan='2'><strong>MR. SLIM</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td-10">Całkowita długość orurowania (dł. mierzona po rurze cieczowej)</td>
							<td class="td-2 text-right">[m]</td>
						</tr>
						<tr>
							<td>Dodatkowa dodana ilość czynnika chłodniczego </td>
							<td class="text-right">[kg]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L1-N</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L2-N</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L3-N</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na tłoczeniu (po 30 min. pracy)</td>
							<td class="text-right">[bar]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na ssaniu (po 30 min. pracy)</td>
							<td class="text-right">[bar]</td>
						</tr>
						<tr>
							<td>Temperatura tłoczenia sprężarki TH4 (po 30 min. pracy)</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S1-S2 (napięcie AC)</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S2-S3 (napięcie DC)</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Temperatura w odsługiwanym pomieszczeniu</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td>Temperatura powietrza nawiewnego (po 30 min. pracy)</td>
							<td class="text-right">[C]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-5">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th  class="gray-bg" scope="col" colspan='2'><strong>GREE</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td-10">Próba szczelności instalacji freonowej</td>
							<td class="td-2 text-right">[bar]</td>
						</tr>
						<tr>
							<td>Czas trwania próby</td>
							<td class="text-right">[h]</td>
						</tr>
						<tr>
							<td>Osuszanie próżniowe</td>
							<td class="text-right">[bar]</td>
						</tr>
						<tr>
							<td>Czas trwania osuszania próżniowego</td>
							<td class="text-right">[min]</td>
						</tr>
						<tr>
							<td>Temp. nawiewu jed. Wew. grzanie (min/max)</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td>Temp. nawiewu jed. Wew. chłodzenie (min/max)</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td>Temp. w budynku podczas badania nawiewu</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td>Temp. na zewnątrz podczas badania nawiewu</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td>Ilość dodanego czynnika chłodniczego</td>
							<td class="text-right">[g]</td>
						</tr>
						<tr>
							<td>Długość wyk. instalacji freonowej</td>
							<td class="text-right">[m]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-7">
				<table class="table table-bordered table-sm" style="padding-right: 10px;">
					<thead class="thead-light">
						<tr>
							<th class="gray-bg" scope="col" colspan='2'><strong>SERIA M</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td-10">Całkowita długość orurowania (dł. mierzona po rurze cieczowej)</td>
							<td class="td-2 text-right">[m]</td>
						</tr>
						<tr>
							<td>Dodatkowa dodana ilość czynnika chłodniczego </td>
							<td class="text-right">[kg]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L-N</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L i uziemieniem</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S1-S2 (napięcie AC)</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami S2-S3 (napięcie DC)</td>
							<td class="text-right">[V]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na ssaniu (po 30 min. pracy)</td>
							<td class="text-right">[bar]</td>
						</tr>
						<tr>
							<td>Temperatura w odsługiwanym pomieszczeniu</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td>Temperatura powietrza nawiewnego (po 30 min. pracy)</td>
							<td class="text-right">[C]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-5">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th class="gray-bg" scope="col" colspan='3'><strong>LOSSNAY</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td-10">Napięcie el. Pomiędzy zaciskami L-N</td>
							<td class="td-2 text-right" colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Nagrzewnica wstępna</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Kanał wlotowy powietrza nachylony<br/>w stronę czerpni</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
						<tr>
							<td>Podłączenie wymiennika kanałowego<br/> Mitsubishi GUG</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8">
				<table class="table table-bordered table-sm" style="padding-right:20px;">
					<thead class="thead-light">
						<tr>
							<th class="gray-bg" scope="col" colspan='3'><strong>CITY MULTI</strong></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="td-10">Ciśnienie w czasie próby ciśnieniowej instalacji chłodniczej</td>
							<td class="td-2 text-right" colspan='2'>[bar]</td>
						</tr>
						<tr>
							<td>Dodatkowa dodana ilość czynnika chłodniczego </td>
							<td class="text-right" colspan='2'>[kg]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na ssaniu (po 30 min. pracy)</td>
							<td class="text-right" colspan='2'>[bar]</td>
						</tr>
						<tr>
							<td>Ciśnienie czynnika chłodniczego na tłoczeniu (po 30 min. pracy)</td>
							<td class="text-right" colspan='2'>[bar]</td>
						</tr>
						<tr>
							<td>Temp. na tłoczeniu sprężarki TH4-1-2-4-6 w pozycji ON (SW6-10 OFF)</td>
							<td class="text-right" colspan='2'>[C]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L1-N</td>
							<td class="text-right" colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L2-N</td>
							<td class="text-right" colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami L3-N</td>
							<td class="text-right" colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Napięcie el. pomiędzy zaciskami TB3 (napięcie DC)</td>
							<td class="text-right" colspan='2'>[V]</td>
						</tr>
						<tr>
							<td>Przekrój ekranowego przewodu komunikacyjnego</td>
							<td class="text-right" colspan='2'>[mm2]</td>
						</tr>
						<tr>
							<td colspan='3'>Nagranie z narzędzia serwisowego CMS</td>
						</tr>
						<tr>
							<td>Liczba jednostek wewnętrznych podpiętych do układu chłodniczego</td>
							<td class="text-right" colspan='2'>[szt]</td>
						</tr>
						<tr>
							<td>Sterowanie centralne</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td colspan='3'>Model sterownika centralnego</td>
						</tr>
						<tr>
							<td>Temperatura w odsługiwanym pomieszczeniu</td>
							<td class="text-right" colspan='2'>[C]</td>
						</tr>
						<tr>
							<td>Temperatura powietrza nawiewnego (po 30 min. pracy)</td>
							<td class="text-right" colspan='2'>[C]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-4"></div>
		</div>
	</div>
@endsection