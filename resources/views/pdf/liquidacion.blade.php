<!DOCTYPE html>
<html>
<head>
	<title>Liq. {{$razonsocial->name}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<style>

		@font-face {
			font-family: "Roboto";
			src: url("' . public_path('fonts/Roboto-Regular.ttf') . '") format("truetype");
			/* Agrega aquí otras variantes de la fuente si las necesitas */
		}
		/* Estilos CSS para la página */
		@page {
			margin-top: 0px;
			margin-bottom: 0px;
			margin-left: 0px;
			margin-right: 0px;
		}
		body {
			font-family: 'Roboto', 'Segoe UI', Tahoma, sans-serif;
			width: 100%;
			margin: 0;
			padding: 0;
		}

		.page-break {
			page-break-after: always;
		}
		html {
			margin: 0;
		}
		.container {
			width: 100%; /* Ancho completo */
            height: 100%;
			background-image: url({{asset('image/bg_informe.png'); }}); /* Ruta de la imagen de fondo */
			background-size: cover; /* Para cubrir toda el área del cuerpo */
			background-position: center; /* Para centrar la imagen */
		}
		.cuerpo {
		margin-left: 30px;
		margin-right: 30px;
		font-size: 12px;
		}
		
		thead {
			border-top: 2px solid black; /* Borde superior */
			border-bottom: 2px solid black; /* Borde inferior */
		}

		th, td {
			padding-top: 3px;
			padding-bottom: 3px;
			padding-left: 2px;
			padding-right: 2px;
			text-align: center;
		}
		.fondo-abajo {
			position: fixed;
			bottom: 0;
			left: 50%;
			transform: translateX(-50%);

			width: calc(100% - 60px); /* El ancho de la imagen es el 100% del ancho de la ventana menos los 60px de margen */
			z-index: -1; /* Coloca la imagen detrás del contenido */
		}

	</style>
</head>

<body>
	
	<div class="container">
		
	</div>	
	
	<div class="cuerpo">

		<img src="{{asset('image/cabecera.png')}}" style="margin-top: 30px;" alt="">
		<h3 style="text-align: center;">CUENTA CORRIENTE</h3>

		{{-- Datos Productor --}}
		<table style="width:100%; margin-bottom:30px; border-collapse: collapse;">
			<thead>
				<tr>
					<td style="text-align: center; border: 1px solid black; padding: 2px;">
						PRODUCTOR
					</td>
					<td style="text-align: center; border: 1px solid black; padding: 2px;">
						{{$razonsocial->rut}}
					</td>
					<td style="text-align: center; border: 1px solid black; padding: 2px;">
						{{$razonsocial->name}}
					</td>
				</tr>
			</thead>
		</table>

		<table style="width:100%;border-collapse: collapse; margin-bottom: 30px;">
		
			<tr style="text-align: left;">
				<td style="text-align: left;">Total venta cerezas exportación temporada 2022-2023 (CAT 1)</td>
				<td>CAT 1</td>
				<td>USD$</td>
				<td>125.650,05</td>
			  </tr>
			<tr style="text-align: left;">
			  <td style="text-align: left;">Total venta cerezas exportación temporada 2022-2023 (CAT I)</td>
			  <td>CAT I</td>
			  <td>USD$</td>
			  <td>25.650,06</td>
			</tr>
			<tr>
				<td>

				</td>
			</tr>
			<tr>
			  <td></td>
			  <td></td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> 125.000,12</td>
			</tr>
		</table>

		<h3 style="text-align: left;">Facturación (proformas)</h3>

		<table style="width:100%;border-collapse: collapse; margin-bottom: 30px;">
		
			<tr style="text-align: left;">
				<td style="text-align: left; width:60%;"></td>
				<td>01/03/05</td>
				<td>USD$</td>
				<td>125.650,05</td>
			  </tr>
			<tr style="text-align: left;">
			  <td style="text-align: left; width:60%;"></td>
			  <td>01/03/05</td>
			  <td>USD$</td>
			  <td>25.650,06</td>
			</tr>
			<tr>
				<td>

				</td>
			</tr>
			<tr>
			  <td style="text-align: left; border: 2px solid black;padding: 2px; margin-top: 5px;" colspan="2"> Total facturación (Proformas)</td>
			  
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> 125.000,12</td>
			</tr>
		</table>

		<h3 style="text-align: left;">Otro cargos</h3>

		<table style="width:100%;border-collapse: collapse;">
		
			<tr style="text-align: left;">
				<td style="text-align: left; width:60%;">Gastos de fruta no exportable</td>
				<td>Kilos 18.500</td>
				<td>USD$</td>
				<td>125.650,05</td>
			  </tr>
			<tr style="text-align: left;">
			  <td style="text-align: left; width:60%;">Cuenta corriente envases</td>
			  <td></td>
			  <td>USD$</td>
			  <td>25.650,06</td>
			</tr>
			<tr style="text-align: left;">
				<td style="text-align: left; width:60%;">Fletes huerto</td>
				<td></td>
				<td>USD$</td>
				<td>25.650,06</td>
			  </tr>
			<tr>
				<td>

				</td>
			</tr>
			<tr>
			  <td style="text-align: left; border: 2px solid black;padding: 2px; margin-top: 5px;" colspan="2"> Total cargos</td>
			  
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> 125.000,12</td>
			</tr>
			<tr>
				<td style="text-align: left; border: 2px solid black;padding: 2px; margin-top: 5px;" colspan="2"> Saldo</td>
				
				<td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
				<td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> 125.000,12</td>
			  </tr>

			
		
		</table>
		<table style="width: 100%;">
			<tr style="text-align: left;">
				<td style="text-align: left; width:60%;"></td>
				<td>T/C</td>
				<td>$814,75</td>
				<td>25.650,06</td>
			  </tr>
		</table>

		<table style="width: 100%; border: 2px solid black; border-collapse: collapse; margin-top: 20px;">
			<tr>
				<td colspan="6" style="font-weight: bold; font-size: 12pt;">
					Nota de Débito
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left; padding: 2px; margin-top: 5px;">
					Ajuste final de precio de cereza exportación
				</td>
				<td style="font-weight: bold;border-left: 2px solid black; border-top: 2px solid black;">
					Neto
				</td>
				<td style="border-top: 2px solid black;">
					$52.451.356
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left; padding: 2px; margin-top: 5px;">
					Temporada 2023-2024
				</td>
				<td style="font-weight: bold;border-left: 2px solid black;">
					Iva
				</td>
				<td>
					$52.451.356
				</td>
			</tr>
			<tr>
				<td colspan="4">
					
				</td>
				<td style="font-weight: bold;border-left: 2px solid black;">
					Total
				</td>
				<td>
					$52.451.356
				</td>
			</tr>
		</table>

		<table style="width: 100%; border: 2px solid black; border-collapse: collapse; margin-top: 20px;">
			<tr>
				<td colspan="6" style="font-weight: bold; font-size: 12pt;">
					Nota de Débito
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left; padding: 2px; margin-top: 5px;">
					Ajuste final de precio de cereza nacional   
				</td>
				<td style="font-weight: bold;border-left: 2px solid black; border-top: 2px solid black;">
					Neto
				</td>
				<td style="border-top: 2px solid black;">
					$52.451.356
				</td>
			</tr>
			<tr>
				<td colspan="4" style="text-align: left; padding: 2px; margin-top: 5px;">
					Temporada 2023-2024
				</td>
				<td style="font-weight: bold;border-left: 2px solid black;">
					Iva
				</td>
				<td>
					$52.451.356
				</td>
			</tr>
			<tr>
				<td colspan="4">
					
				</td>
				<td style="font-weight: bold;border-left: 2px solid black;">
					Total
				</td>
				<td>
					$52.451.356
				</td>
			</tr>
		</table>

		<table style="width: 100%; border: 2px solid black; border-collapse: collapse; margin-top: 20px;">
		
			<tr>
				<td style="text-align: left; padding: 2px; margin-top: 5px; width:70%;">
					
				</td>
				<td style="font-weight: bold;border-left: 2px solid black; border-top: 2px solid black; width:15%;">
					Neto
				</td>
				<td style="border-top: 2px solid black; width:15%;">
					$52.451.356
				</td>
			</tr>
			<tr>
				<td style="text-align: right; padding: 2px; margin-top: 5px; width:70%; font-weight: bold; font-size:12pt; padding-right: 110px; ">
					Total Final
				</td>
				<td style="font-weight: bold;border-left: 2px solid black; width:15%;">
					Iva
				</td>
				<td style=" width:15%;">
					$52.451.356
				</td>
			</tr>
			<tr>
				<td style=" width:70%;">
					
				</td>
				<td style="font-weight: bold;border-left: 2px solid black; width:15%;">
					Total
				</td>
				<td style=" width:15%;">
					$52.451.356
				</td>
			</tr>
		</table>
		{{-- comment
			<img src="{{asset('image/footer.png')}}" class="fondo-abajo" style="margin-bottom: 30px;">
		 --}}
		<div class="page-break"></div>

		<img src="{{asset('image/cabecera.png')}}" style="margin-top: 30px;" alt="">
		
		<table id="balance" style="width:100%; border-collapse: collapse;">
			<thead>
			  <tr>
				<th>Especie</th>
				<th>Variedad</th>
				<th>Categoría</th>
				<th>Serie</th>
				<th>% Curva<br>
					Calibre </th>
				<th>Cajas</th>
				<th>Peso Neto</th>
				<th>Retorno Neto<br> Total</th>
				<th>Retorno Kilo</th>
			  </tr>
			</thead>
			<tbody>
				@php
					$variedadcount=1;
					$cantidadtotal=0;
					$pesonetototal=0;
					$retornototal=0;
				@endphp
				@foreach ($unique_variedades as $variedad)
					@php
						$calibrecount=1;
						
						$cantidad4j=0;
						$cantidad3j=0;
						$cantidad2j=0;
						$cantidadj=0;
						$cantidadxl=0;
						$pesoneto4j=0;
						$pesoneto3j=0;
						$pesoneto2j=0;
						$pesonetoj=0;
						$pesonetoxl=0;
						$retorno4j=0;
						$retorno3j=0;
						$retorno2j=0;
						$retornoj=0;
						$retornoxl=0;
					@endphp

					@foreach ($masas as $masa)
					
							@if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad)
									@php
										$cantidad4j+=$masa->cantidad;
										$pesoneto4j+=$masa->peso_neto;
										foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
											$retorno4j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
											$retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
										break;
										}
										$cantidadtotal+=$masa->cantidad;
										$pesonetototal+=$masa->peso_neto;
									@endphp	
							@endif
							@if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad)
									@php
										$cantidad3j+=$masa->cantidad;
										$pesoneto3j+=$masa->peso_neto;
										foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
											$retorno3j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
											$retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
										break;
										}
										$cantidadtotal+=$masa->cantidad;
										$pesonetototal+=$masa->peso_neto;
									@endphp	
							@endif
							@if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad)
									@php
										$cantidad2j+=$masa->cantidad;
										$pesoneto2j+=$masa->peso_neto;
										foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
											$retorno2j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
											$retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
										break;
										}
										$cantidadtotal+=$masa->cantidad;
										$pesonetototal+=$masa->peso_neto;
									@endphp	
							@endif
							@if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad)
									@php
										$cantidadj+=$masa->cantidad;
											$pesonetoj+=$masa->peso_neto;
											foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
												$retornoj+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
												$retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
											break;
										}
											$cantidadtotal+=$masa->cantidad;
										$pesonetototal+=$masa->peso_neto;
									@endphp	
							@endif
							@if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad)
									@php
										$cantidadxl+=$masa->cantidad;
										$pesonetoxl+=$masa->peso_neto;
										foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
											$retornoxl+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
											$retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
										break;
										}
										$cantidadtotal+=$masa->cantidad;
										$pesonetototal+=$masa->peso_neto;
									@endphp	
							@endif
						
						
					@endforeach

						@if ($unique_calibres->contains('4J') || $unique_calibres->contains('4JD') || $unique_calibres->contains('4JDD'))
							<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>Cat 1</td>
								@else
									<td> </td>
								@endif
								
								
								
								<td>4J</td>
								<td>{{number_format($cantidad4j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
								<td>{{$cantidad4j}}</td>
								<td>{{$pesoneto4j}} KGS</td>
								<td>{{$retorno4j}} USD</td>
								<td>
									@if ($pesoneto4j)
										{{number_format($retorno4j/$pesoneto4j,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
								
							</tr>
							@php
								$calibrecount+=1;
							@endphp
						@endif
						@if ($unique_calibres->contains('3J') || $unique_calibres->contains('3JD') || $unique_calibres->contains('3JDD'))
							<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>Cat 1</td>
								@else
									<td> </td>
								@endif
								
								
								<td>3J</td>
								<td>{{number_format($cantidad3j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
								
								<td>{{$cantidad3j}}</td>
								<td>{{$pesoneto3j}} KGS</td>
								<td>{{$retorno3j}} USD</td>
								<td>
									@if ($pesoneto3j)
										{{number_format($retorno3j/$pesoneto3j,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
								
							</tr>
							@php
								$calibrecount+=1;
							@endphp
						@endif
						@if ($unique_calibres->contains('2J') || $unique_calibres->contains('2JD') || $unique_calibres->contains('2JDD'))
							<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>Cat 1</td>
								@else
									<td> </td>
								@endif
								
								
								<td>2J</td>
								<td>{{number_format($cantidad2j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
								
								<td>{{$cantidad2j}}</td>
								<td>{{$pesoneto2j}} KGS</td>
								<td>{{$retorno2j}} USD</td>
								<td>
									@if ($pesoneto2j)
										{{number_format($retorno2j/$pesoneto2j,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
								
							</tr>
							@php
								$calibrecount+=1;
							@endphp
						@endif
						@if ($unique_calibres->contains('J') || $unique_calibres->contains('JD') || $unique_calibres->contains('JDD'))
							<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>Cat 1</td>
								@else
									<td> </td>
								@endif
								
								
								
								<td>J</td>
								<td>{{number_format($cantidadj*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
								<td>{{$cantidadj}}</td>
								<td>{{$pesonetoj}} KGS</td>
								<td>{{$retornoj}} USD</td>
								<td>
									@if ($pesonetoj)
										{{number_format($retornoj/$pesonetoj,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
	
								
							</tr>
							@php
								$calibrecount+=1;
							@endphp
						@endif
						@if ($unique_calibres->contains('XL') || $unique_calibres->contains('XLD') || $unique_calibres->contains('XLDD'))
							<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>Cat 1</td>
								@else
									<td> </td>
								@endif
								
								
								
								<td>XL</td>
								<td>{{number_format($cantidadxl*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
								<td>{{$cantidadxl}}</td>
								<td>{{$pesonetoxl}} KGS</td>
								<td>{{$retornoxl}} USD</td>
						  		<td>
									@if ($pesonetoxl)
										{{number_format($retornoxl/$pesonetoxl,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
								
							</tr>
							@php
								$calibrecount+=1;
							@endphp
						@endif

						<tr>
							
								<td> </td>
						
						
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
							
							
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						
							
							
							
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">100,00%</td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl}}</td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl}} KGS</td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl}} USD</td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}} USD/KG</td>
							
						</tr>
						

						@php
							$variedadcount+=1;
						@endphp
					

				@endforeach

				<tr>
							
					
				
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
					
					
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
				
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
				
					
					
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidadtotal}}</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$retornototal}} USD</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal/$pesonetototal,2)}} usd/kg</td>
					
				</tr>
						{{-- comment
							<tr>
								<td>C-14</td>
								<td>Cherries</td>
								<td>Cat 1</td>
								<td>3J</td>
								<td>1,91%</td>
								<td>102</td>
								<td>510 Kg USD</td>
								<td>2.749 USD</td>
								<td>5,39</td>
								
							</tr>
							<tr>
								<td>C-14</td>
								<td>Cherries</td>
								<td>Cat 1</td>
								<td>2J</td>
								<td>14,05%</td>
								<td>750</td>
								<td>3.750 Kg USD</td>
								<td>16.466 USD</td>
								<td>4,39</td>
								
							</tr>
							<tr>
								<td>C-14</td>
								<td>Cherries</td>
								<td>Cat 1</td>
								<td>J</td>
								<td>33,21%</td>
								<td>1.773</td>
								<td>8.865 Kg USD</td>
								<td>25.663 USD</td>
								<td>2,89</td>
								
							</tr>
							<tr>
								<td>C-14</td>
								<td>Cherries</td>
								<td>Cat 1</td>
								<td>XL</td>
								<td>50,76%</td>
								<td>2.710</td>
								<td>13.550 Kg USD</td>
								<td>10.465 USD</td>
								<td>0,77</td>
								
							</tr>
						--}}

			</tbody>
		</table>
		<div class="page-break"></div>
		<h1 class="mt-6">
			Desglose por semanas
			</h1>

			<table id="balance" style="width:100%; border-collapse: collapse;">
				<thead>
				  <tr>
				  <th>Especie</th>
				  <th>Variedad</th>
				  <th>Categoría</th>
				  <th>Semana embarque</th>
				  <th>Serie</th>
				  <th>Color </th>
				  <th>Cajas</th>
				  <th>Peso Neto</th>
				  <th>Retorno Neto<br> Total</th>
				  <th>Retorno Kilo</th>
				  </tr>
				</thead>
				<tbody>
				  @php
					$variedadcount=1;
					$cantidadtotal=0;
					$pesonetototal=0;
					$retornototal=0;
				  @endphp
				  @foreach ($unique_variedades as $variedad)
				   
					@php
						$calibrecount=1;
						
					@endphp
					 
					@foreach ($unique_semanas as $semana)

					  @php
						
					   
						$cantidad4j=0;
						$cantidad3j=0;
						$cantidad2j=0;
						$cantidadj=0;
						$cantidadxl=0;
						$pesoneto4j=0;
						$pesoneto3j=0;
						$pesoneto2j=0;
						$pesonetoj=0;
						$pesonetoxl=0;
						$retorno4j=0;
						$retorno3j=0;
						$retorno2j=0;
						$retornoj=0;
						$retornoxl=0;
					  @endphp
			
					  @foreach ($masas as $masa)
					  
						  @if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							  @php
								$cantidad4j+=$masa->cantidad;
								$pesoneto4j+=$masa->peso_neto;
								foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
								  $retorno4j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  break;
								}
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
							  @endphp	
						  @endif
						  @if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							  @php
								$cantidad3j+=$masa->cantidad;
								$pesoneto3j+=$masa->peso_neto;
								foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
								  $retorno3j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  break;
								}
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
							  @endphp	
						  @endif
						  @if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							  @php
								$cantidad2j+=$masa->cantidad;
								$pesoneto2j+=$masa->peso_neto;
								foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
								  $retorno2j+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  break;
								}
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
							  @endphp	
						  @endif
						  @if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							  @php
								  $cantidadj+=$masa->cantidad;
								  $pesonetoj+=$masa->peso_neto;
								  foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
									$retornoj+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
									$retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
									break;
								  }
								  $cantidadtotal+=$masa->cantidad;
								  $pesonetototal+=$masa->peso_neto;
							  @endphp	
						  @endif
						  @if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							  @php
								$cantidadxl+=$masa->cantidad;
								$pesonetoxl+=$masa->peso_neto;
								foreach ($fobs->where('n_variedad',$masa->n_variedad)->where('semana',$masa->semana) as $fob){
								  $retornoxl+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  $retornototal+=intval($masa->peso_neto)*intval($fob->fob_kilo_salida);
								  break;
								}
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
							  @endphp	
						  @endif
					   
						
					  @endforeach
					 
					  @php
						$semanacount=0;
					  @endphp

					  @if ($cantidad4j>0)
						<tr>
						  @if ($variedadcount==1 && $calibrecount==1)
							<td>Cherries</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>Cat 1</td>
						  @else
							<td> </td>
						  @endif
						  
						  
						  @if ($semanacount==0)
							<td>{{$semana}}</td>
						  @else
							<td> </td>
						  @endif

						  <td>4J</td>
						  <td>{{number_format($cantidad4j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
						  <td>{{$cantidad4j}}</td>
						  <td>{{$pesoneto4j}} KGS</td>
						  <td>{{$retorno4j}} USD</td>
						  <td>
									@if ($pesoneto4j)
										{{number_format($retorno4j/$pesoneto4j,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
						</tr>
						@php
						  $semanacount+=1;
						  $calibrecount+=1;
						@endphp
					  @endif
					  @if ($cantidad3j>0)
						<tr>
						  @if ($variedadcount==1 && $calibrecount==1)
							<td>Cherries</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>Cat 1</td>
						  @else
							<td> </td>
						  @endif
						  
						 @if ($semanacount==0)
							<td>{{$semana}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  <td>3J</td>
						  <td>{{number_format($cantidad3j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
						  
						  <td>{{$cantidad3j}}</td>
						  <td>{{$pesoneto3j}} KGS</td>
						  <td>{{$retorno3j}} USD</td>
						  <td>
									@if ($pesoneto3j)
										{{number_format($retorno3j/$pesoneto3j,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
						</tr>
						@php
						  $calibrecount+=1;
						  $semanacount+=1;
						@endphp
					  @endif
					  @if ($cantidad2j>0)
						<tr>
						  @if ($variedadcount==1 && $calibrecount==1)
							<td>Cherries</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>Cat 1</td>
						  @else
							<td> </td>
						  @endif
						  
						  @if ($semanacount==0)
							<td>{{$semana}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  <td>2J</td>
						  <td>{{number_format($cantidad2j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
						  
						  <td>{{$cantidad2j}}</td>
						  <td>{{$pesoneto2j}} KGS</td>
						  <td>{{$retorno2j}} USD</td>
						  <td>
									@if ($pesoneto2j)
										{{number_format($retorno2j/$pesoneto2j,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
						</tr>
						@php
						  $calibrecount+=1;
						  $semanacount+=1;
						@endphp
					  @endif
					  @if ($cantidadj>0)
						<tr>
						  @if ($variedadcount==1 && $calibrecount==1)
							<td>Cherries</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>Cat 1</td>
						  @else
							<td> </td>
						  @endif
						  
						  
						  @if ($semanacount==0)
							<td>{{$semana}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  <td>J</td>
						  <td>{{number_format($cantidadj*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
						  <td>{{$cantidadj}}</td>
						  <td>{{$pesonetoj}} KGS</td>
						  <td>{{$retornoj}} USD</td>
						  <td>
									@if ($pesonetoj)
										{{number_format($retornoj/$pesonetoj,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
						</tr>
						@php
						  $calibrecount+=1;
						  $semanacount+=1;
						@endphp
					  @endif
					  @if ($cantidadxl>0)
						<tr>
						  @if ($variedadcount==1 && $calibrecount==1)
							<td>Cherries</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  @if ($calibrecount==1)
							<td>Cat 1</td>
						  @else
							<td> </td>
						  @endif
						  
						  
						  @if ($semanacount==0)
							<td>{{$semana}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  <td>XL</td>
						  <td>{{number_format($cantidadxl*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
						  <td>{{$cantidadxl}}</td>
						  <td>{{$pesonetoxl}} KGS</td>
						  <td>{{$retornoxl}} USD</td>
						  <td>
									@if ($pesonetoxl)
										{{number_format($retornoxl/$pesonetoxl,2)}} USD/kg
									@else
										0 USD/kg
									@endif
								</td>
						</tr>
						@php
						  $calibrecount+=1;
						  $semanacount+=1;
						@endphp
					  @endif

					  @if ($cantidad4j>0 || $cantidad3j>0 || $cantidad2j>0 || $cantidadj>0 || $cantidadxl>0)
						<tr>
						  
						  <td> </td>
					  
					  
						  <td> </td>
						  <td> </td>
					  
						
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$semana}} </td>
					  
						
						
						
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl}}</td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl}} KGS</td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)}}  USD</td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}}  USD/KGS</td>
						  
						</tr>
					  @endif
					  @php
						  $semanacount+=1;
					  @endphp
					  
					@endforeach
					  @if ($cantidad4j>0 || $cantidad3j>0 || $cantidad2j>0 || $cantidadj>0 || $cantidadxl>0)
						<tr>
						  
							<td> </td>
						
						
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
						  
						  
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						
						  
						  
						  
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl)}}</td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl)}} KGS</td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)}}  USD</td>
						  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))}}  USD/KG</td>
						  
						</tr>
					  @endif
		  
					  @php
						$variedadcount+=1;
					  @endphp
					
		  
				  @endforeach
		  
				  <tr>
						
					
				  
					  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total General</td>
					
					  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
					
					  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
				  
					  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
				  
					
					
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidadtotal}}</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KG</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$retornototal}} USD</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal/$pesonetototal,2)}} usd/kg</td>
					
				  </tr>
				 
				</tbody>
			</table>

		{{-- comment
		<div class="flex flex-col">
			<div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
			  <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
			  
				<h1 class="mt-6">
				  Gastos Frio Packing
				</h1>
				<table class="min-w-full leading-normal mt-4">
				  <thead>
					<tr>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						Especie
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						Nombre Productor
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  CSG
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						KG
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						TotalUSD
					  </th>
					  <th
					  class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  NETO
					</th>
				  
				  </tr>
				  </thead>
				  <tbody>
					
					  @foreach ($packings as $packing)
						<tr>
						  
						  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							<p class="text-gray-900 whitespace-no-wrap"> {{$packing->especie}}</p>
						  </td>
						  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							<div class="flex items-center">
							
								<div class="ml-3">
								  <p class="text-gray-900 whitespace-no-wrap">
									{{$packing->n_productor}}
								  </p>
								</div>
							  </div>
						  </td>
						  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							<p class="text-gray-900 whitespace-no-wrap"> {{$packing->csg}}</p>
						  </td>
						  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							<p class="text-gray-900 whitespace-no-wrap">
							  {{$packing->kg}}
							</p>
						  </td>
						  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							<p class="text-gray-900 whitespace-no-wrap">
							
							  {{number_format($packing->total_usd,2)}}
							</p>
						  </td>

						  <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							<span
												  class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
												  <span aria-hidden
													  class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
							<span class="relative">Activo</span>
							</span>
						  </td>
						</tr>
					  @endforeach
				  
				  </tbody>
				</table>

				<h1 class="mt-6">
				  Comision
				  </h1>
				
				 <table class="min-w-full leading-normal">
				   <thead>
					 <tr>
					   <th
						 class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						 Productor
					   </th>
					   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					   Comisión
					   </th>
					   <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						 Acción
						 </th>
					 
				   
				   </tr>
				   </thead>
				   <tbody>
				 
					   @foreach ($comisions as $comision)
						 <tr>
						   <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							 <div class="flex items-center">
							   <div class="flex-shrink-0 w-10 h-10 hidden">
								
								 <div class="ml-3">
								   <p class="text-gray-900 whitespace-no-wrap">
									 {{$comision->productor}}
								   </p>
								 </div>
							   </div>
						   </td>
						   <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							 <p class="text-gray-900 whitespace-no-wrap"> {{$comision->comision*100}}%</p>
						   </td>
					   
					   

						   <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
							 <span
												   class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
												   <span aria-hidden
													   class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
							 <span class="relative">Editar</span>
							 </span>
						   </td>
						 </tr>
					   @endforeach
			 
				   </tbody>
				 </table>

				<h1 class="mt-6">
				  Gastos exportacion, pendiente (Tipo_nave)
				</h1>
				<table class="min-w-full leading-normal">
				  <thead>
					<tr>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						TIPO/NAVE
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					   -
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  -
					  </th>
					  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  -
					  </th>
					  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						-
					  </th>
					  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  -
					</th>
				  
				  </tr>
				  </thead>
				  <tbody>
					
				  </tbody>
				</table>
				<h1 class="mt-6">
				 Flete a Huerto
				</h1>
				<table class="min-w-full leading-normal">
				  <thead>
					<tr>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						TIPO/NAVE
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					   -
					  </th>
					  <th
						class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  -
					  </th>
					  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  -
					  </th>
					  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
						-
					  </th>
					  <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
					  -
					</th>
				  
				  </tr>
				  </thead>
				  <tbody>
					
				  </tbody>
				</table>
			   
				@foreach ($masas as $masa)
				  {{$masa->n_centrocosto}}<br>
				@endforeach

				</div>
			  </div>
			</div>

			@foreach ($masas as $masa)
				{{$masa->id}}<br>
			@endforeach
		</div>
	 --}}
	</body>
</html>