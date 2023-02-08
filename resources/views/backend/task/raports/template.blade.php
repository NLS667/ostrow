@extends ('backend.layouts.pdf', ['activePage' => 'task-management', 'titlePage' => __('Raport Zadania')])

@section('content')
	<div class="container">
		<!-- Header Section -->
		<table class="table-borderless mb-10">
			<tbody>
				<tr class="green-bg td-12">
					<td class="td-3 white-bg" rowspan="3" style="padding-right: 20px;">
						<img  src="{{ asset('/img/bioclim_logo.jpg') }}" style="width: 100%;"/>
					</td>
					<td class="td-1"></td>
					<td class="td-2 text-right">
						Tel. 608 516 632
					</td>
					<td class="td-3 text-center">
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
		<!-- Header Section End -->
	@if ($service->service_type == "Klimatyzacja")
		@if ( $task->type == "Montaż" )
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
							<td>Kontrola temperatury nawiewanego powietrza</td>
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
		<div class="row" style="margin-bottom:20px;">
			<div class="col-xs-12">
				<p style="font-size:10px;"><strong>UWAGI / ZALECENIA / Wykonywanie przeglądów serwisowych zgodnie z kartą gwarancyjną:</strong></p>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
			</div>
		</div>
		<div class="row" style="margin-bottom:100px; font-size:12px;">
			<div class="col-xs-6"><strong>PŁATNOŚĆ:</strong>&nbsp;&nbsp;&#9634;&nbsp;GOTÓWKA&nbsp;&nbsp;&#9634;&nbsp;PRZELEW</div>
			<div class="col-xs-6"><strong>POTWIERDZENIE:</strong>&nbsp;&nbsp;&#9634;&nbsp;PARAGON&nbsp;&nbsp;&#9634;&nbsp;FAKTURA</div>
		</div>
		<div class="row" style="font-size:12px;">
			<div class="col-xs-6 text-center border-top">SERWISANT</div>
			<div class="col-xs-6 text-center border-top">ZAMAWIAJĄCY</div>
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
		@else

		@endif
	</div>
	@elseif($service->service_type == "Pompa Ciepła")
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-bordered table-sm">
					<thead class="thead-light">
						<tr>
							<th class="td-3 gray-bg text-center" colspan="6"><strong>POMPA CIEPŁA</strong></th>
						</tr>
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
		<div class="row" style="margin-bottom:20px;">
			<div class="col-xs-12">
				<p style="font-size:10px;"><strong>UWAGI / ZALECENIA / Wykonywanie przeglądów serwisowych zgodnie z kartą gwarancyjną:</strong></p>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
				<div class="typing-line"></div>
			</div>
		</div>
		<div class="row" style="margin-bottom:100px; font-size:12px;">
			<div class="col-xs-6"><strong>PŁATNOŚĆ:</strong>&nbsp;&nbsp;&#9634;&nbsp;GOTÓWKA&nbsp;&nbsp;&#9634;&nbsp;PRZELEW</div>
			<div class="col-xs-6"><strong>POTWIERDZENIE:</strong>&nbsp;&nbsp;&#9634;&nbsp;PARAGON&nbsp;&nbsp;&#9634;&nbsp;FAKTURA</div>
		</div>
		<div class="row" style="font-size:12px;">
			<div class="col-xs-6 text-center border-top">SERWISANT</div>
			<div class="col-xs-6 text-center border-top">ZAMAWIAJĄCY</div>
		</div>
	</div>
	<div class="page-break"></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 gray-bg">
				<strong>POMPA CIEPŁA - jednostka zewnętrzna</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-7">
				<table class="table table-bordered table-sm" style="padding-right: 10px;">
					<tbody>
						<tr>
							<td class="td-10" colspan="2">Całkowita długość orurowania (dł. mierzona po rurze cieczowej)</td>
							<td class="td-2 text-right" colspan="2">[m]</td>
						</tr>
						<tr>
							<td colspan="2">Dodatkowo dodana ilość czynnika chłodniczego</td>
							<td class="text-right" colspan="2">[kg]</td>
						</tr>
						<tr>
							<td colspan="2">Napięcie el. pomiędzy zaciskami L1-N</td>
							<td class="text-right" colspan="2">[V]</td>
						</tr>
						<tr>
							<td colspan="2">Napięcie el. pomiędzy zaciskami L2-N</td>
							<td class="text-right" colspan="2">[V]</td>
						</tr>
						<tr>
							<td colspan="2">Napięcie el. pomiędzy zaciskami L3-N</td>
							<td class="text-right" colspan="2">[V]</td>
						</tr>
						<tr>
							<td colspan="2">Usunięto blokady transportowe sprężarki</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td colspan="2">Zastosowano grzałkę tacy ociekowej</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td colspan="2">Wysokość posadowienia agregatu nad powierzchnią gruntu</td>
							<td class="text-right" colspan="2">[cm]</td>
						</tr>
						<tr>
							<td colspan="2">Pojemność zbiornika buforowego w instalacji wodnej</td>
							<td class="text-right" colspan="2">[l]</td>
						</tr>
						<tr>
							<td colspan="2">Powierzchnia wężownicy w zbiorniku C.W.U.</td>
							<td class="text-right" colspan="2">[m2]</td>
						</tr>
						<tr>
							<td>Ilość stref w  budynku</td>
							<td class="td-1 text-center">1 obieg</td>
							<td class="td-1 text-center">2 obieg</td>
							<td class="td-1">Inne:</td>
						</tr>
						<tr>
							<td colspan="2">Rodzaj instalacji w strefie 1</td>
							<td class="td-1 text-right">podłogowe</td>
							<td class="td-1 text-right">grzejniki</td>
						</tr>
						<tr>
							<td colspan="2">Rodzaj instalacji w strefie 2</td>
							<td class="td-1 text-right">podłogowe</td>
							<td class="td-1 text-right">grzejniki</td>
						</tr>
						<tr>
							<td colspan="2">Pompy obiegowe stref grzewczych sterowane za pomocą</td>
							<td class="td-1 text-right">hydrobox</td>
							<td class="td-1 text-right">Inne:</td>
						</tr>
						<tr>
							<td colspan="2">Temp. wody zasilającej strefę THW6 (po 30 min)</td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td colspan="2">Temp. wody powrotnej ze strefy THW7 (po 30 min) </td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td colspan="2">Temp. wody zasilającej strefę 2 THW8 (po 30 min)</td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td colspan="2">Temp. wody powrotnej ze strefy 2 THW9 (po 30 min) </td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-5">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td class="td-10">Zasilanie międzyfazowe L1-L2</td>
							<td class="td-2 text-right" colspan="2">[V]</td>
						</tr>
						<tr>
							<td>Zasilanie międzyfazowe L1-L3</td>
							<td class="text-right" colspan="2">[V]</td>
						</tr>
						<tr>
							<td>Zasilanie międzyfazowe L2-L3</td>
							<td class="text-right" colspan="2">[V]</td>
						</tr>
						<tr>
							<td>Pomiar prądu urządzenia L1</td>
							<td class="text-right" colspan="2">[A]</td>
						</tr>
						<tr>
							<td>Pomiar prądu urządzenia L2</td>
							<td class="text-right" colspan="2">[A]</td>
						</tr>
						<tr>
							<td>Pomiar prądu urządzenia L3</td>
							<td class="text-right" colspan="2">[A]</td>
						</tr>
						<tr>
							<td>Temp. w  budynku</td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td>Temp. gazu na wejściu do<br/>wymiennika płytowego</td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td>Temp. gazu na wyjściu ze sprężarki</td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td>Jednostka zew. Zamontowana na<br/>podkładach wiatroizolacyjnych</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Przeprowadzono szkolenie<br/>użytkownika</td>
							<td class="text-center">TAK</td>
							<td class="text-center">NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px;">
			<div class="col-xs-12">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td>Sterowanie realizowane na podstawie  </td>
							<td>PAR-WT</td>
							<td>Term. Pomieszczeniowy</td>
							<td>Krzywa grzewcza</td>
							<td>Temp. przepływu</td>
							<td>Temp. pomieszczenia</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 gray-bg">
				<strong>POMPA CIEPŁA - jednostka wewnętrzna</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-7">
				<table class="table table-bordered table-sm" style="padding-right: 10px;">
					<tbody>
						<tr>
							<td class="td-10">Temp. wody na wyjściu z jednostki wew. THW1 (po 30 min)</td>
							<td class="td-2 text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td>Temp. wody na powrocie z instalacji THW2 (po 30 min)</td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td>Temp. cieczy na wyjściu z wymiennika freonowego TH2 (po 30 min)</td>
							<td class="text-right" colspan="2">[C]</td>
						</tr>
						<tr>
							<td>Zainstalowano w  urządzeniu kartę SD</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Doprowadzono zasilanie do grzałek elektrycznych w hydroboxie </td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-5">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td class="td-6">Zużycie z ost. roku:</td>
							<td class="td-6 text-right">[kWh]</td> 
						</tr>
						<tr>
							<td>Zużycie na CWU:</td>
							<td class="text-right">[kWh]</td> 
						</tr>
						<tr>
							<td>Zużycie na CO:</td>
							<td class="text-right">[kWh]</td> 
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 gray-bg">
				<strong>KODY SERWISOWE:</strong>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px;">
			<div class="col-xs-7">
				<table class="table table-bordered table-sm" style="padding-right: 10px;">
					<tbody>
						<tr>
							<td class="td-1 text-center">540</td>
							<td class="td-6">Natężenie przepływu (przepływ wody na j. wew.)</td>
							<td class="td-3 text-right">[l/min]</td>
						</tr>
						<tr>
							<td class="text-center">002</td>
							<td>Godziny pracy (od początku uruchomienia) (x100)</td>
							<td class="text-right">[h]</td>
						</tr>
						<tr>
							<td class="text-center">003</td>
							<td>Ilość włączeń sprężarki  (x10)</td>
							<td class="text-right">[szt]</td>
						</tr>
						<tr>
							<td class="text-center">004</td>
							<td>Temp. gazu gorącego TH4</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td class="text-center">012</td>
							<td>Przegrzanie gazu gorącego</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td class="text-center">013</td>
							<td>Przechłodzenie</td>
							<td class="text-right">[C]</td>
						</tr>
						<tr>
							<td class="text-center">025</td>
							<td>Prąd pracy</td>
							<td class="text-right">[A]</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 gray-bg">
				<strong>KODY SERWISOWE:</strong>
			</div>
		</div>
		<div class="row" style="margin-bottom:10px;">
			<div class="col-xs-7">
				<table class="table table-bordered table-sm" style="padding-right: 10px;">
					<tbody>
						<tr>
							<td>Sprawdzono zawór nadciśnieniowy = <br/>kontrola działania (przekręcić pokrętło)</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie filtrów wody technologicznej</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Czyszczenie skraplacza</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Kontrola temperatury czynnika grzewczego</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-xs-5">
				<table class="table table-bordered table-sm">
					<tbody>
						<tr>
							<td>Kontrola szczelności instalacji</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Sprawdzenie instalacji elektrycznej - pomiary</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Sprawdzenie instalacji freonowej – pomiary temp. czynnika</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
						<tr>
							<td>Sprawdzenie szczelności inst. odprowadzenia skroplin</td>
							<td class="td-1 text-center">TAK</td>
							<td class="td-1 text-center">NIE</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@elseif($service->service_type == "Pompa ciepła")
		
	@endif
@endsection