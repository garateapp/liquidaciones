<!DOCTYPE html>
<html>
<head>
	<title>Liq. {{$razonsocial->name}}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href=”https://fonts.googleapis.com/css?family=Pacifico” rel=”stylesheet”>
	<link rel="shortcut icon" href="{{asset('image/iconogreenex.png')}}">
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
			background-image: url({{asset('image/bg_informe.jpg'); }}); /* Ruta de la imagen de fondo */
			background-size: cover; /* Para cubrir toda el área del cuerpo */
			background-position: center; /* Para centrar la imagen */
		}
		.cuerpo {
		margin-left: 30px;
		margin-right: 30px;
		font-size: 10px;
		}
		
		thead {
			border-top: 2px solid black; /* Borde superior */
			border-bottom: 2px solid black; /* Borde inferior */
		}

		th, td {
			padding-top: 1px;
			padding-bottom: 1px;
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

		<table id="balance" style="display: none;">
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
			
			<th class="bg-yellow-100">Retorno Neto<br> Total</th>
			<th class="bg-yellow-100">Retorno Kilo</th>
			</tr>
			</thead>
			<tbody>
			@php
				$variedadcount=1;
				$cantidadtotal=0;
				$pesonetototal=0;
				$retornototal=0;
				$exportaciontotal=0;
				$totalcostopacking=0;
				$totalmateriales=0;
				$globalfletehuerto=0;
				$kgsglobmas=0;

			@endphp
			@foreach ($unique_variedades as $variedad)
				@php
				$calibrecount=1;
				
				$cantidad4j=0;
				$cantidad3j=0;
				$cantidad2j=0;
				$cantidadj=0;
				$cantidadxl=0;

				$exportacion4j=0;
				$exportacion3j=0;
				$exportacion2j=0;
				$exportacionj=0;
				$exportacionxl=0;

				$material4j=0;
				$material3j=0;
				$material2j=0;
				$materialj=0;
				$materialxl=0;

				$flete4j=0;
				$flete3j=0;
				$flete2j=0;
				$fletej=0;
				$fletexl=0;

				$pesoneto4j=0;
				$pesoneto3j=0;
				$pesoneto2j=0;
				$pesonetoj=0;
				$pesonetoxl=0;
				$pesonetol=0;
				$retorno4j=0;
				$retorno3j=0;
				$retorno2j=0;
				$retornoj=0;
				$retornoxl=0;
				$costopacking=0;

				$fletehuerto=0;
				
				$kgstotmas=0;
				@endphp

				@foreach ($masas as $masa)
				@if ($masa->n_etiqueta!='Loica' || $masa->n_categoria=='Cat 1')
					@if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad)
						@php
						$cantidad4j+=$masa->cantidad;
						$pesoneto4j+=$masa->peso_neto;
							$retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
						$cantidadtotal+=$masa->cantidad;
						$pesonetototal+=$masa->peso_neto;
						if ($masa->tipo_transporte=='AEREO') {
								if ($exportacions->where('type','aereo')->count()>0) {
								$exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								}
							}
						if ($masa->tipo_transporte=='MARITIMO') {
							if ($exportacions->where('type','maritimo')->count()>0) {
								$exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
							}
							}
							foreach ($materialestotal as $material) {
							if ($material->c_embalaje==$masa->c_embalaje) {
								$material4j+=$masa->cantidad*$material->costo_por_caja_usd;
								$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
							}  
							}
							foreach ($fletestotal as $flete) {
								if ($flete->rut==$masa->r_productor) {
								$flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								}  
							}
						@endphp	
						
					@endif
					@if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad)
						@php
						$cantidad3j+=$masa->cantidad;
						$pesoneto3j+=$masa->peso_neto;
							$retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
						$cantidadtotal+=$masa->cantidad;
						$pesonetototal+=$masa->peso_neto;
						if ($masa->tipo_transporte=='AEREO') {
								if ($exportacions->where('type','aereo')->count()>0) {
								$exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								}
							}
						if ($masa->tipo_transporte=='MARITIMO') {
							if ($exportacions->where('type','maritimo')->count()>0) {
								$exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
							}
							}
							foreach ($materialestotal as $material) {
							if ($material->c_embalaje==$masa->c_embalaje) {
								$material3j+=$masa->cantidad*$material->costo_por_caja_usd;
								$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
							}  
							}
							foreach ($fletestotal as $flete) {
								if ($flete->rut==$masa->r_productor) {
								$flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								}  
							}
						@endphp	
					@endif
					@if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad)
						@php
						$cantidad2j+=$masa->cantidad;
						$pesoneto2j+=$masa->peso_neto;
							$retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
						$cantidadtotal+=$masa->cantidad;
						$pesonetototal+=$masa->peso_neto;
						if ($masa->tipo_transporte=='AEREO') {
								if ($exportacions->where('type','aereo')->count()>0) {
								$exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								}
							}
						if ($masa->tipo_transporte=='MARITIMO') {
							if ($exportacions->where('type','maritimo')->count()>0) {
								$exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
							}
							}
							foreach ($materialestotal as $material) {
							if ($material->c_embalaje==$masa->c_embalaje) {
								$material2j+=$masa->cantidad*$material->costo_por_caja_usd;
								$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
							}  
							}
							foreach ($fletestotal as $flete) {
								if ($flete->rut==$masa->r_productor) {
								$flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								}  
							}
						@endphp	
					@endif
					@if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad)
						@php
						$cantidadj+=$masa->cantidad;
							$pesonetoj+=$masa->peso_neto;
							$retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
						$pesonetototal+=$masa->peso_neto;
						if ($masa->tipo_transporte=='AEREO') {
								if ($exportacions->where('type','aereo')->count()>0) {
								$exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								}
							}
						if ($masa->tipo_transporte=='MARITIMO') {
							if ($exportacions->where('type','maritimo')->count()>0) {
								$exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
							}
							}
							foreach ($materialestotal as $material) {
							if ($material->c_embalaje==$masa->c_embalaje) {
								$materialj+=$masa->cantidad*$material->costo_por_caja_usd;
								$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
							}  
							}
							foreach ($fletestotal as $flete) {
								if ($flete->rut==$masa->r_productor) {
								$fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								}  
							}
						@endphp	
					@endif
					@if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad)
						@php
						$cantidadxl+=$masa->cantidad;
						$pesonetoxl+=$masa->peso_neto;
							$retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
						$cantidadtotal+=$masa->cantidad;
						$pesonetototal+=$masa->peso_neto;
						if ($masa->tipo_transporte=='AEREO') {
								if ($exportacions->where('type','aereo')->count()>0) {
								$exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
								}
							}
						if ($masa->tipo_transporte=='MARITIMO') {
							if ($exportacions->where('type','maritimo')->count()>0) {
								$exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
							}
							}
							foreach ($materialestotal as $material) {
							if ($material->c_embalaje==$masa->c_embalaje) {
								$materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
								$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
							}  
							}
						
							foreach ($fletestotal as $flete) {
								if ($flete->rut==$masa->r_productor) {
								$fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
								}  
							}
				
						@endphp	
					@endif
					
				@endif
				@endforeach
				@foreach ($masas as $masa)
				@php
					if ($masa->n_variedad==$variedad) {
						$kgstotmas+=$masa->peso_neto;
						$kgsglobmas+=$masa->peso_neto;
					}
				@endphp
				@endforeach
				@php
				foreach ($packings as $costo) {
					if ($costo->variedad==$variedad) {
					$costopacking+=$costo->total_usd;
					}  
				}
				$totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas;
				
				@endphp
	
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
				
					{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
					<td>{{number_format($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
					<td>
						@if ($pesoneto4j)
						{{number_format(($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
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
					
					{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
					<td>{{number_format($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j+$flete3j,2,',','.')}} USD</td>
					<td>
						@if ($pesoneto3j)
						{{number_format(($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j+$flete3j)/$pesoneto3j,2)}} USD/kg
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
					
					{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
					<td>{{number_format($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
					<td>
						@if ($pesoneto2j)
						{{number_format(($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
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
					
					{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
					<td>{{number_format($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
					<td>
						@if ($pesonetoj)
						{{number_format(($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
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
					
					{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
					<td>{{number_format($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
						<td>
						@if ($pesonetoxl)
						{{number_format(($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
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
					{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl),2,',','.')}} USD</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}} USD/KG</td>
					
				</tr>
				
	
				@php
					$variedadcount+=1;
				@endphp
				
	
			@endforeach
	
			<tr>
					
				
			
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
				
				
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
			
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
			
				
				
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($cantidadtotal)}}</td>
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($pesonetototal)}} KGS</td>
				{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto)/$pesonetototal,2)}} usd/kg</td>
				
			</tr>

	
			</tbody>
		</table>
		@php
			$totaldentrodenorma=$retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto;
		@endphp
		<table id="balance" style="display: none;">
			<thead>
			<tr>
			<th>Especie</th>
			<th>Categoría</th>
			<th>Variedad</th>
			
			<th>Serie</th>
			<th>% Curva<br>
				Calibre </th>
			<th>Cajas</th>
			<th>Peso Neto</th>
			
			<th  class="bg-yellow-100">Retorno Neto<br> Total</th>
			<th class="bg-yellow-100">Retorno Kilo</th>
			</tr>
			</thead>
			<tbody>
				@php
					$variedadcount=1;
					$supercantidadtotal=0;
					$superpesonetototal=0;
					$superretornototal=0;
					$superexportaciontotal=0;
					$globalfletehuerto=0;
					$supertotalmateriales=0;
					$supertotalcostopacking=0;
					@endphp
				@foreach ($unique_categorias as $categoria)
					@php
					$fletehuerto=0;
					$totalcostopacking=0;
					$variedadcount=1;
					$cantidadtotal=0;
					$pesonetototal=0;
					$retornototal=0;
					$exportaciontotal=0;
					$totalmateriales=0;
					$kgsglobmas=0;

						$subflete4j=0;
						$subflete3j=0;
						$subflete2j=0;
						$subfletej=0;
						$subfletexl=0;
						$subfletel=0;

					@endphp

					@foreach ($unique_variedades as $variedad)
					@php
						$costopacking=0;
						$calibrecount=1;
						
						$cantidad4j=0;
						$cantidad3j=0;
						$cantidad2j=0;
						$cantidadj=0;
						$cantidadxl=0;
						$cantidadl=0;

						$exportacion4j=0;
						$exportacion3j=0;
						$exportacion2j=0;
						$exportacionj=0;
						$exportacionxl=0;
						$exportacionl=0;
		
						$pesoneto4j=0;
						$pesoneto3j=0;
						$pesoneto2j=0;
						$pesonetoj=0;
						$pesonetoxl=0;
						$pesonetol=0;
		
						$retorno4j=0;
						$retorno3j=0;
						$retorno2j=0;
						$retornoj=0;
						$retornoxl=0;
						$retornol=0;

						$flete4j=0;
						$flete3j=0;
						$flete2j=0;
						$fletej=0;
						$fletexl=0;
						$fletel=0;

						$material4j=0;
						$material3j=0;
						$material2j=0;
						$materialj=0;
						$materialxl=0;
						$materiall=0;

						$kgstotmas=0;
					@endphp
			
					@foreach ($masas as $masa)
						@if (($masa->n_etiqueta=='Loica' || $masa->n_calibre=='L' || $masa->n_calibre=='LD') && $masa->n_categoria==$categoria && $categoria!='Vega')
						
						@if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidad4j+=$masa->cantidad;
							$pesoneto4j+=$masa->peso_neto;
								$retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$material4j+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$subflete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
							
						@endif
						@if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidad3j+=$masa->cantidad;
							$pesoneto3j+=$masa->peso_neto;
								$retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$material3j+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$subflete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
						@endif
						@if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidad2j+=$masa->cantidad;
							$pesoneto2j+=$masa->peso_neto;
								$retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$material2j+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$subflete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
						@endif
						@if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidadj+=$masa->cantidad;
								$pesonetoj+=$masa->peso_neto;
								$retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$materialj+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$subfletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
						@endif
						@if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad)
							@php
							$cantidadxl+=$masa->cantidad;
							$pesonetoxl+=$masa->peso_neto;
								$retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$subfletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
						@endif
						@if (($masa->n_calibre=='L' || $masa->n_calibre=='LD') && $masa->n_variedad==$variedad)
							@php
								$cantidadl+=$masa->cantidad;
								$pesonetol+=$masa->peso_neto;
								$retornol+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
										$exportacionl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacionl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
								}
								foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
									$materiall+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$fletel+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$subfletel+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
								
						@endif
						
						@endif
						
					@endforeach
					
					@foreach ($masas as $masa)
						@php
						if ($masa->n_variedad==$variedad) {
							$kgstotmas+=$masa->peso_neto;
							$kgsglobmas+=$masa->peso_neto;
						}
						@endphp
					@endforeach
					@php
						foreach ($packings as $costo) {
						if ($costo->variedad==$variedad) {
							$costopacking+=$costo->total_usd;
						
						}  
						}
						$totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas;
						$supertotalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas;
					@endphp
		
					@if (($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol)>0)
						
						
						@if (($unique_calibres->contains('4J') || $unique_calibres->contains('4JD') || $unique_calibres->contains('4JDD')) && $pesoneto4j>0)
							<tr>
							@if ($variedadcount==1 && $calibrecount==1)
								<td>Cherries</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$categoria}}</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$variedad}}</td>
							@else
								<td> </td>
							@endif
							
							
							
							
							<td>4J</td>
							@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
								<td>{{number_format($cantidad4j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
							@else
								<td>0</td>
							@endif
								
							<td>{{$cantidad4j}}</td>
							<td>{{$pesoneto4j}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td>{{number_format($retorno4j*0.92-(($costopacking*$pesoneto4j)/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
							<td>
								@if ($pesoneto4j)
								{{number_format(($retorno4j*0.92-(($costopacking*$pesoneto4j)/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
								@else
								0 USD/kg
								@endif
							</td>
							
							</tr>
							@php
							$calibrecount+=1;
							@endphp
						@endif
						
						@if (($unique_calibres->contains('3J') || $unique_calibres->contains('3JD') || $unique_calibres->contains('3JDD')) && $pesoneto3j>0)
							<tr>
							@if ($variedadcount==1 && $calibrecount==1)
								<td>Cherries</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$categoria}}</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$variedad}}</td>
							@else
								<td> </td>
							@endif
							
							
							
							<td>3J</td>
							@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
								<td>{{number_format($cantidad3j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
							@else
								<td>0</td>	
							@endif
		
							<td>{{$cantidad3j}}</td>
							<td>{{$pesoneto3j}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td>{{number_format($retorno3j*0.92-(($costopacking*$pesoneto3j)/$kgstotmas)-$exportacion3j-$material3j-$flete3j,2,',','.')}} USD</td>
							<td>
								@if ($pesoneto3j)
								{{number_format(($retorno3j*0.92-(($costopacking*$pesoneto3j)/$kgstotmas)-$exportacion3j-$material3j-$flete3j)/$pesoneto3j,2)}} USD/kg
								@else
								0 USD/kg
								@endif
							</td>
							
							</tr>
							@php
							$calibrecount+=1;
							@endphp
						@endif
						
						@if (($unique_calibres->contains('2J') || $unique_calibres->contains('2JD') || $unique_calibres->contains('2JDD')) && $pesoneto2j>0)
							<tr>
							@if ($variedadcount==1 && $calibrecount==1)
								<td>Cherries</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$categoria}}</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$variedad}}</td>
							@else
								<td> </td>
							@endif
							
							
							
							<td>2J</td>
		
							@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
								<td>{{number_format($cantidad2j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
							@else
								<td>0</td>
							@endif
							
							<td>{{$cantidad2j}}</td>
							<td>{{$pesoneto2j}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td>{{number_format($retorno2j*0.92-(($costopacking*$pesoneto2j)/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
						
							<td>
								@if ($pesoneto2j)
								{{number_format(($retorno2j*0.92-(($costopacking*$pesoneto2j)/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
								@else
								0 USD/kg
								@endif
							</td>
							
							</tr>
							@php
							$calibrecount+=1;
							@endphp
						@endif
						
						@if (($unique_calibres->contains('J') || $unique_calibres->contains('JD') || $unique_calibres->contains('JDD')) && $pesonetoj>0)
							<tr>
							@if ($variedadcount==1 && $calibrecount==1)
								<td>Cherries</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$categoria}}</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$variedad}}</td>
							@else
								<td> </td>
							@endif
							
							
							
							
							<td>J</td>
							@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
								<td>{{number_format($cantidadj*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
							@else
								<td>0</td>
							@endif
							
							<td>{{$cantidadj}}</td>
							<td>{{$pesonetoj}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td>{{number_format($retornoj*0.92-(($costopacking*$pesonetoj)/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
							<td>
								@if ($pesonetoj)
								{{number_format(($retornoj*0.92-(($costopacking*$pesonetoj)/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
								@else
								0 USD/kg
								@endif
							</td>
				
							
							</tr>
							@php
							$calibrecount+=1;
							@endphp
						@endif
						
						@if (($unique_calibres->contains('XL') || $unique_calibres->contains('XLD') || $unique_calibres->contains('XLDD')) && $pesonetoxl>0)
							<tr>
							@if ($variedadcount==1 && $calibrecount==1)
								<td>Cherries</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$categoria}}</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$variedad}}</td>
							@else
								<td> </td>
							@endif
							
							
							
							
							<td>XL</td>
							@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
								<td>{{number_format($cantidadxl*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
							@else
								<td>0</td>	
							@endif
		
							<td>{{$cantidadxl}}</td>
							<td>{{$pesonetoxl}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td>{{number_format($retornoxl*0.92-(($costopacking*$pesonetoxl)/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
						
							<td>
								@if ($pesonetoxl)
								{{number_format(($retornoxl*0.92-(($costopacking*$pesonetoxl)/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
								@else
								0 USD/kg
								@endif
							</td>
							
							</tr>
							@php
							$calibrecount+=1;
							@endphp
						@endif
						
						@if (($unique_calibres->contains('L') || $unique_calibres->contains('LD')) && $pesonetol>0)
							<tr>
							@if ($variedadcount==1 && $calibrecount==1)
								<td>Cherries</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$categoria}}</td>
							@else
								<td> </td>
							@endif
							@if ($calibrecount==1)
								<td>{{$variedad}}</td>
							@else
								<td> </td>
							@endif
							
							
							
							
							<td>L</td>
							@if (($cantidadl+$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl)>0)
								<td>{{number_format($cantidadl*100/($cantidadl+$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
							@else
								<td>0</td>	
							@endif
		
							<td>{{$cantidadl}}</td>
							<td>{{$pesonetol}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td>{{number_format($retornol*0.92-(($costopacking*$pesonetol)/$kgstotmas)-$exportacionl-$materiall-$fletel,2,',','.')}} USD</td>
						
							<td>
								@if ($pesonetol)
								{{number_format(($retornol*0.92-(($costopacking*$pesonetol)/$kgstotmas)-$exportacionl-$materiall-$fletel)/$pesonetol,2)}} USD/kg
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
							<td> </td>
						
						
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
							
							
							
							
							
							
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">100,00%</td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl}}</td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas)-($material4j+$material3j+$material2j+$materialj+$materialxl+$materiall)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl+$exportacionl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl+$fletel),2,',','.')}} USD</td>
						
							@if (($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol)>0)
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas)-($material4j+$material3j+$material2j+$materialj+$materialxl+$materiall)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl+$exportacionl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl+$fletel))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol),2)}} USD/KG</td>
							@else
							<td>0</td>	
							@endif
						</tr>
						
			
						@php
						$variedadcount+=1;
						
					
						$supercantidadtotal+=$cantidadtotal;
						$superpesonetototal+=$pesonetototal;
						$superretornototal+=$retornototal; 
					
						@endphp
					
					@endif
			
					@endforeach
		
					@if (($cantidadtotal+$pesonetototal)>0)
					<tr>
							
						
						<td></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$categoria}}</td>
						
						
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
					
						
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidadtotal}}</td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$fletehuerto,2,',','.')}} USD</td>
						
						@if ($pesonetototal>0)
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal/$pesonetototal,2)}} usd/kg</td>
						@else
						<td>0</td>
						@endif
					</tr>
					@endif
		
				@endforeach
	
			<tr>
						
					
					
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
				
				
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
			
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
			
				
				
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$supercantidadtotal}}</td>
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$superpesonetototal}} KGS</td>
				{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal*0.92-($supertotalcostopacking)-$superexportaciontotal-$supertotalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
				@if ($superpesonetototal>0)
				<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal/$superpesonetototal,2)}} usd/kg</td>
				@else
				<td>0</td>
				@endif
			</tr>
	
			</tbody>
		</table>

		@php
			$totalfueradenorma=$superretornototal*0.92-($supertotalcostopacking)-$superexportaciontotal-$supertotalmateriales-$globalfletehuerto;
		@endphp

		<table id="balance" style="display: none;">
			<thead>
				<tr>
				
				<th>Variedad</th>
				
				<th>Serie</th>
				
				
				<th>Peso Neto</th>
				<th>Ingreso Comercial</th>
				
				</tr>
			</thead>
			<tbody>
				@php
					$variedadcount=1;
					$cantidadtotal=0;
					$pesonetototal=0;
					$retornototal=0;
					$totalcostopacking=0;
					$kgsglobmas=0;
				@endphp
				@foreach ($unique_variedades as $variedad)
					@php
					$calibrecount=1;
					$costopacking=0;
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
					$kgstotmas=0;
					@endphp

					@foreach ($masas as $masa)
					@if ($masa->n_calibre=='Comercial' || $masa->n_calibre=='Precalibre' || $masa->n_calibre=='Desecho' || $masa->n_calibre=='Merma')
						@if (($masa->n_calibre=='Comercial') && $masa->n_variedad==$variedad)
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
						@if (($masa->n_calibre=='Precalibre') && $masa->n_variedad==$variedad)
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
						@if (($masa->n_calibre=='Desecho') && $masa->n_variedad==$variedad)
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
						@if (($masa->n_calibre=='Merma') && $masa->n_variedad==$variedad)
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
						
						
					@endif
					
					@endforeach
					@foreach ($masas as $masa)
					@php
						if ($masa->n_variedad==$variedad) {
							$kgstotmas+=$masa->peso_neto;
							$kgsglobmas+=$masa->peso_neto;
						}
					@endphp
					@endforeach
					@php
						foreach ($packings as $costo) {
						if ($costo->variedad==$variedad) {
							$costopacking+=$costo->total_usd;
						}  
						}
						$totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj))/$kgstotmas;
					
					@endphp

						<tr>
						
						@if ($calibrecount==1)
							<td>{{$variedad}}</td>
						@else
							<td> </td>
						@endif
						
						
						
						
						<td>Comercial</td>
						
						<td>{{$pesoneto4j}} KGS</td>
						{{-- Retorno - CostoPacking --}}
						<td>{{number_format($retorno4j-($costopacking*$pesoneto4j)/$kgstotmas,2,',','.')}} USD</td>
						
						
						</tr>
						@php
						$calibrecount+=1;
						@endphp
						<tr>
						
						@if ($calibrecount==1)
							<td>{{$variedad}}</td>
						@else
							<td> </td>
						@endif
						
						
						
						<td>Precalibre</td>
						
						
						<td>{{$pesoneto3j}} KGS</td>
						{{-- Retorno - CostoPacking --}}
						<td>{{number_format($retorno3j-($costopacking*$pesoneto3j)/$kgstotmas,2,',','.')}} USD</td>
						
						
						</tr>
						@php
						$calibrecount+=1;
						@endphp
						<tr>
						
						@if ($calibrecount==1)
							<td>{{$variedad}}</td>
						@else
							<td> </td>
						@endif
						
						
						
						<td>Desecho</td>
						
						
						<td>{{$pesoneto2j}} KGS</td>
						{{-- Retorno - CostoPacking --}}
						<td>{{number_format($retorno2j-($costopacking*$pesoneto2j)/$kgstotmas,2,',','.')}} USD</td>
						
						
						</tr>
						@php
						$calibrecount+=1;
						@endphp
				
						<tr>
						
						@if ($calibrecount==1)
							<td>{{$variedad}}</td>
						@else
							<td> </td>
						@endif
						
						
						
						<td>Merma</td>
						
						
						<td>{{$pesonetoj}} KGS</td>
						{{-- Retorno - CostoPacking --}}
						<td>{{number_format($retornoj-(($costopacking*$pesonetoj)/$kgstotmas),2,',','.')}} USD</td>
						
						
						</tr>
						@php
						$calibrecount+=1;
						@endphp
					

					

					<tr>
						
						
					
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj}}</td>
						{{-- Retorno - CostoPacking --}}
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retorno4j+$retorno3j+$retorno2j+$retornoj-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj))/$kgstotmas),2,',','.')}} USD</td>
						
					</tr>
					

					@php
						$variedadcount+=1;
					@endphp
					

				@endforeach

				<tr>
						
					
				
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
					
					
					
					
					
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
					{{-- Retorno - CostoPacking --}}
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal-($totalcostopacking),2,',','.')}} USD</td>
				
				</tr>
					

			</tbody>
		</table>
		@php
			$gastosfrutanoexp=$totalcostopacking;
			$pesofrutanoexport=$pesonetototal;
		@endphp
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

			@php
				$cat1=0;
				$kspcat1=0;
				$costoexportcat1=0;

				$cati=0;
				$kspcati=0;
				$costoexportcati=0;

				$costopacking=$packings->first()->total_usd;

			@endphp
			@foreach ($masas as $masa)
				@if ($masa->n_categoria=='Cat 1')
						@php
							if($masa->precio_fob){
								$cat1+=$masa->peso_neto*$masa->precio_fob;
							}else{
								$kspcat1+=$masa->peso_neto;
							}
							if ($masa->tipo_transporte=='AEREO') {
                                    if ($exportacions->where('type','aereo')->count()>0) {
                                      	$costoexportcat1+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                    }
                            }
                            if ($masa->tipo_transporte=='MARITIMO') {
                              	if ($exportacions->where('type','maritimo')->count()>0) {
									$costoexportcat1+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                }
                            }
						@endphp	
				@endif
				@if (strtolower($masa->n_categoria)=='cat i')
						@php
							if($masa->precio_fob){
								$cati+=$masa->peso_neto*$masa->precio_fob;
							}else{
								$kspcati+=$masa->peso_neto;
							}
							if ($masa->tipo_transporte=='AEREO') {
                                    if ($exportacions->where('type','aereo')->count()>0) {
                                      	$costoexportcati+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
                                    }
                            }
                            if ($masa->tipo_transporte=='MARITIMO') {
                              	if ($exportacions->where('type','maritimo')->count()>0) {
									$costoexportcati+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
                                }
                            }
						@endphp	
				@endif
			@endforeach

		<table style="width:100%;border-collapse: collapse; margin-bottom: 30px;">
		
			<tr style="text-align: left;">
				<td style="text-align: left;">Total venta cerezas exportación temporada 2022-2023 (CAT 1)</td>
				<td>CAT 1</td>
				<td>USD$</td>
				
				<td>
					{{number_format($totaldentrodenorma,2,',','.')}}
				</td>
			  </tr>
			<tr style="text-align: left;">
			  <td style="text-align: left;">Total venta cerezas exportación temporada 2022-2023 (CAT I)</td>
			  <td>CAT I</td>
			  <td>USD$</td>
			  <td>
				{{number_format($totalfueradenorma,2,',','.')}}
			</td>
			</tr>
			<tr>
				<td>

				</td>
			</tr>
			<tr>
			  <td></td>
			  <td></td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> {{number_format($totaldentrodenorma+$totalfueradenorma,2)}}</td>
			</tr>
		</table>

		<h3 style="text-align: left;">Facturación (proformas)</h3>

		<table style="width:100%;border-collapse: collapse; margin-bottom: 30px;">
			@php
				$totalproforma=0;
			@endphp
			@foreach ($anticipos as $anticipo)
				@php
					$fechaprint=new DateTime($anticipo->fecha);
					$totalproforma+=floatval($anticipo->cantidad);
				@endphp
				<tr style="text-align: left;">
					<td style="text-align: left; width:60%;"></td>
					<td>{{$fechaprint->format('d-m-Y')}}</td>
					<td>USD$</td>
					<td>{{number_format(floatval($anticipo->cantidad),2)}}</td>
				</tr>
				
			@endforeach

			<tr>
				<td>

				</td>
			</tr>
			<tr>
			  <td style="text-align: left; border: 2px solid black;padding: 2px; margin-top: 5px;" colspan="2"> Total facturación (Proformas)</td>
			  
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> {{number_format($totalproforma,2)}}</td>
			</tr>
		</table>

						@php
							
							$cantidadtotal=0;
							$pesonetototal=0;
						@endphp
	
						@foreach ($masas as $masa)
							@if ($masa->n_calibre=='Comercial' || $masa->n_calibre=='Precalibre' || $masa->n_calibre=='Desecho' || $masa->n_calibre=='Merma')
								
										@php
											$cantidadtotal+=$masa->peso_neto*1.092;
											$pesonetototal+=$masa->peso_neto;
										@endphp	
								
								
							@endif
							
						@endforeach

		<h3 style="text-align: left;">Otro cargos</h3>

		<table style="width:100%;border-collapse: collapse;">
		
			<tr style="text-align: left;">
				<td style="text-align: left; width:60%;">Gastos de fruta no exportable</td>
				<td>Kilos {{number_format($pesofrutanoexport)}}</td>
				<td>USD$</td>
				<td>{{number_format($gastosfrutanoexp)}}</td>
			  </tr>
			  @php
				  $totalgastos=$cantidadtotal;
			  @endphp

			@foreach ($gastos as $gasto)
				@if ($gasto->familia->name=='Cuenta Corriente')
			  		@foreach ($detalles as $detalle)
						@if (preg_replace('/[\.\-\s]+/', '', strtolower($detalle->item))==preg_replace('/[\.\-\s]+/', '', strtolower($gasto->item)))
							
							<tr style="text-align: left;">
										<td style="text-align: left; width:60%;">{{$gasto->item}}</td>
										<td></td>
										<td>USD$</td>
										<td>{{number_format(floatval($detalle->cantidad),2)}}</td>
							</tr>
							@php
								$totalgastos+=floatval($detalle->cantidad);
							@endphp
							
						@endif
					@endforeach
				@endif
			@endforeach

			


				<td>

				</td>
			</tr>
			<tr>
			  <td style="text-align: left; border: 2px solid black;padding: 2px; margin-top: 5px;" colspan="2"> Total cargos</td>
			  
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
			  <td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> {{number_format($totalgastos,2)}}</td>
			</tr>
			<tr>
				<td style="text-align: left; border: 2px solid black;padding: 2px; margin-top: 5px;" colspan="2"> Saldo</td>
				
				<td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> USD$</td>
				<td style="text-align: center; border: 2px solid black;padding: 2px; margin-top: 5px;"> {{number_format(($cat1+$cati)-($totalgastos+$totalproforma),2)}}</td>
			  </tr>

			
		
		</table>
		<table style="width: 100%;">
			<tr style="text-align: left;">
				<td style="text-align: left; width:60%;"></td>
				<td>T/C</td>
				@if ($razonsocial->tc)
					<td>${{$razonsocial->tc}}</td>
				@else
					<td>$814,75</td>
				@endif
				

				@if ($razonsocial->tc)
					<td>{{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*$razonsocial->tc,0)}}</td>
				@else
					<td>{{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*814.75,0)}}</td>
				@endif

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

					@if ($razonsocial->tc)
						${{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*$razonsocial->tc,0)}}
					@else
						${{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*814.75,0)}}
					@endif
					
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
					@if ($razonsocial->tc)
						${{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*$razonsocial->tc*0.19,0)}}
					@else
						${{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*814.75*0.19,0)}}
					@endif
				</td>
			</tr>
			<tr>
				<td colspan="4">
					
				</td>
				<td style="font-weight: bold;border-left: 2px solid black;">
					Total
				</td>
				<td>
					@if ($razonsocial->tc)
						${{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*$razonsocial->tc*1.19,0)}}
					@else
						${{number_format((($cat1+$cati)-($totalgastos+$totalproforma))*814.75*1.19,0)}}
					@endif
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

		<img src="{{asset('image/cabecera.png')}}" style="margin-top: 30px; margin-bottom: 15px;" alt="">
		<h3 style="text-align: center; margin: 0; line-height: 1;">EXPORTACIÓN DENTRO DE NORMA</h3>
		<p style="text-align: center; margin: 0; line-height: 1;" >{{$razonsocial->name}}</p>
		
			<table id="balance" style="width:100%; border-collapse: collapse; margin-top: 20px;">
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
				
				<th class="bg-yellow-100">Retorno Neto<br> Total</th>
				<th class="bg-yellow-100">Retorno Kilo</th>
				</tr>
				</thead>
				<tbody>
				@php
					$variedadcount=1;
					$cantidadtotal=0;
					$pesonetototal=0;
					$retornototal=0;
					$exportaciontotal=0;
					$totalcostopacking=0;
					$totalmateriales=0;
					$globalfletehuerto=0;
					$kgsglobmas=0;

				@endphp
				@foreach ($unique_variedades as $variedad)
					@php
					$calibrecount=1;
					
					$cantidad4j=0;
					$cantidad3j=0;
					$cantidad2j=0;
					$cantidadj=0;
					$cantidadxl=0;

					$exportacion4j=0;
					$exportacion3j=0;
					$exportacion2j=0;
					$exportacionj=0;
					$exportacionxl=0;

					$material4j=0;
					$material3j=0;
					$material2j=0;
					$materialj=0;
					$materialxl=0;

					$flete4j=0;
					$flete3j=0;
					$flete2j=0;
					$fletej=0;
					$fletexl=0;

					$pesoneto4j=0;
					$pesoneto3j=0;
					$pesoneto2j=0;
					$pesonetoj=0;
					$pesonetoxl=0;
					$pesonetol=0;
					$retorno4j=0;
					$retorno3j=0;
					$retorno2j=0;
					$retornoj=0;
					$retornoxl=0;
					$costopacking=0;

					$fletehuerto=0;
					
					$kgstotmas=0;
					@endphp

					@foreach ($masas as $masa)
					@if ($masa->n_etiqueta!='Loica' || $masa->n_categoria=='Cat 1')
						@if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidad4j+=$masa->cantidad;
							$pesoneto4j+=$masa->peso_neto;
								$retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$material4j+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
							
						@endif
						@if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidad3j+=$masa->cantidad;
							$pesoneto3j+=$masa->peso_neto;
								$retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$material3j+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
						@endif
						@if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidad2j+=$masa->cantidad;
							$pesoneto2j+=$masa->peso_neto;
								$retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$material2j+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
						@endif
						@if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad)
							@php
							$cantidadj+=$masa->cantidad;
								$pesonetoj+=$masa->peso_neto;
								$retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$materialj+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
							@endphp	
						@endif
						@if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad)
							@php
							$cantidadxl+=$masa->cantidad;
							$pesonetoxl+=$masa->peso_neto;
								$retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
									if ($exportacions->where('type','aereo')->count()>0) {
									$exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
									}
								}
							if ($masa->tipo_transporte=='MARITIMO') {
								if ($exportacions->where('type','maritimo')->count()>0) {
									$exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
								}
								}
								foreach ($materialestotal as $material) {
								if ($material->c_embalaje==$masa->c_embalaje) {
									$materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
									$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
								}  
								}
							
								foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
									$fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
								}
					
							@endphp	
						@endif
						
					@endif
					@endforeach
					@foreach ($masas as $masa)
					@php
						if ($masa->n_variedad==$variedad) {
							$kgstotmas+=$masa->peso_neto;
							$kgsglobmas+=$masa->peso_neto;
						}
					@endphp
					@endforeach
					@php
					foreach ($packings as $costo) {
						if ($costo->variedad==$variedad) {
						$costopacking+=$costo->total_usd;
						}  
					}
					$totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas;
					
					@endphp
		
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
					
						{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
						<td>{{number_format($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
						<td>
							@if ($pesoneto4j)
							{{number_format(($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
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
						
						{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
						<td>{{number_format($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j+$flete3j,2,',','.')}} USD</td>
						<td>
							@if ($pesoneto3j)
							{{number_format(($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j+$flete3j)/$pesoneto3j,2)}} USD/kg
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
						
						{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
						<td>{{number_format($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
						<td>
							@if ($pesoneto2j)
							{{number_format(($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
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
						
						{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
						<td>{{number_format($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
						<td>
							@if ($pesonetoj)
							{{number_format(($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
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
						
						{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
						<td>{{number_format($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
							<td>
							@if ($pesonetoxl)
							{{number_format(($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
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
						{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl),2,',','.')}} USD</td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}} USD/KG</td>
						
					</tr>
					
		
					@php
						$variedadcount+=1;
					@endphp
					
		
				@endforeach
		
				<tr>
						
					
				
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
					
					
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
				
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
				
					
					
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($cantidadtotal)}}</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($pesonetototal)}} KGS</td>
					{{-- Retorno - Comision - CostoPacking - Exportacion - Flete Huerto- Materiales --}}
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto)/$pesonetototal,2)}} usd/kg</td>
					
				</tr>
	
		
				</tbody>
			</table>

		
		
			@php
				$n=1;
			@endphp
			@foreach ($graficos as $item)
				<table style="width:100%; margin: 50px auto;">
					<tr>
						
						
						<td>
							<img style="width:80%;" src="{{$item}}" alt="" >
						</td>
							
					</tr>
				</table>
				@if ($n==1 || $n==4 || $n==7)
					<div class="page-break"></div>
				@endif
				@php
					$n+=1;
				@endphp
				
			@endforeach
			
		

		@if ($n>2)
			
			<div class="page-break"></div>
		@endif
			
			<img src="{{asset('image/cabecera.png')}}" style="margin-top: 30px; margin-bottom: 15px;" alt="">

		<h3 style="text-align: center; margin: 0; line-height: 1;">EXPORTACIÓN DENTRO DE NORMA</h3>
		<p style="text-align: center; margin: 0; line-height: 1;" >Detalle por semana de embarque</p>
		<p style="text-align: center; margin: 0; line-height: 1;" >{{$razonsocial->name}}</p>

			<table id="balance" style="width:100%; border-collapse: collapse; margin-top: 15px;">
				<thead>
				<tr>
				<th>Especie</th>
				<th>Variedad</th>
				<th>Categoría</th>
				<th>Semana embarque</th>
				<th>Serie</th>
				<th>% Curva<br>
					Calibre </th>
				<th>Cajas</th>
				<th>Peso Neto</th>
					<th class="bg-yellow-100">Retorno Neto<br> Total</th>
				<th class="bg-yellow-100">Retorno Kilo</th>
				</tr>
				</thead>
				<tbody>
				@php
				$variedadcount=1;
				$cantidadtotal=0;
				$pesonetototal=0;
				$retornototal=0;
				$kgsglobmas=0;
				$totalcostopacking=0;
				$exportaciontotal=0;
				$totalmateriales=0;
				$globalfletehuerto=0;

				@endphp
				@foreach ($unique_variedades as $variedad)
					

					@php

						$submaterial4j=0;
						$submaterial3j=0;
						$submaterial2j=0;
						$submaterialj=0;
						$submaterialxl=0;

					$subexportacion4j=0;
					$subexportacion3j=0;
					$subexportacion2j=0;
					$subexportacionj=0;
					$subexportacionxl=0;

					$subcantidad4j=0;
					$subcantidad3j=0;
					$subcantidad2j=0;
					$subcantidadj=0;
					$subcantidadxl=0;

					$calibrecount=1;

					$subretorno4j=0;
					$subretorno3j=0;
					$subretorno2j=0;
					$subretornoj=0;
					$subretornoxl=0;

					$subpesoneto4j=0;
					$subpesoneto3j=0;
					$subpesoneto2j=0;
					$subpesonetoj=0;
					$subpesonetoxl=0;

					$subflete4j=0;
					$subflete3j=0;
					$subflete2j=0;
					$subfletej=0;
					$subfletexl=0;

					
					$fletehuerto=0;
					
					
					@endphp
				
					
					
					@foreach ($unique_semanas as $semana)
		
					@php    
					
					

						$material4j=0;
						$material3j=0;
						$material2j=0;
						$materialj=0;
						$materialxl=0;
					
						$exportacion4j=0;
						$exportacion3j=0;
						$exportacion2j=0;
						$exportacionj=0;
						$exportacionxl=0;
						
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

						$flete4j=0;
						$flete3j=0;
						$flete2j=0;
						$fletej=0;
						$fletexl=0;

						$kgstotmas=0;
						$costopacking=0;

					@endphp
				
					@foreach ($masas as $masa)
						@if ($masa->n_etiqueta!='Loica' || $masa->n_categoria=='Cat 1')
						@if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							@php
							$cantidad4j+=$masa->cantidad;
							$subcantidad4j+=$masa->cantidad;
							$pesoneto4j+=$masa->peso_neto;
							$subpesoneto4j+=$masa->peso_neto;
							$retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$subretorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$subexportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$subexportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$material4j+=$masa->cantidad*$material->costo_por_caja_usd;
										$submaterial4j+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
										$flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subflete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
									}
							@endphp	
						@endif
						@if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							@php
							$cantidad3j+=$masa->cantidad;
							$subcantidad3j+=$masa->cantidad;
							$pesoneto3j+=$masa->peso_neto;
							$subpesoneto3j+=$masa->peso_neto;
							$retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$subretorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$subexportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$subexportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$material3j+=$masa->cantidad*$material->costo_por_caja_usd;
										$submaterial3j+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
										$flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subflete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
									}
							@endphp	
						@endif
						@if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							@php
							$cantidad2j+=$masa->cantidad;
							$subcantidad2j+=$masa->cantidad;
							$pesoneto2j+=$masa->peso_neto;
							$subpesoneto2j+=$masa->peso_neto;
							$retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$subretorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$subexportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$subexportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$material2j+=$masa->cantidad*$material->costo_por_caja_usd;
										$submaterial2j+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
										$flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subflete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
									}
							@endphp	
						@endif
						@if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							@php
							$cantidadj+=$masa->cantidad;
							$subcantidadj+=$masa->cantidad;
							$pesonetoj+=$masa->peso_neto;
							$subpesonetoj+=$masa->peso_neto;
							$retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$subretornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
							if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$subexportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$subexportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$materialj+=$masa->cantidad*$material->costo_por_caja_usd;
										$submaterialj+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
										$fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subfletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
									}
							@endphp	
						@endif
						@if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
							@php
							$cantidadxl+=$masa->cantidad;
							$subcantidadxl+=$masa->cantidad;
							$pesonetoxl+=$masa->peso_neto;
							$subpesonetoxl+=$masa->peso_neto;
							$retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$subretornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
							$cantidadtotal+=$masa->cantidad;
							$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$subexportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$subexportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
										$submaterialxl+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
									if ($flete->rut==$masa->r_productor) {
										$fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subfletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
									}  
									}
							@endphp	
						@endif
						
						@endif
					@endforeach
					@foreach ($masas as $masa)
						@php
						if ($masa->n_variedad==$variedad) {
							$kgstotmas+=$masa->peso_neto;
							$kgsglobmas+=$masa->peso_neto;
						}
						@endphp
					@endforeach
					@php
						foreach ($packings as $costo) {
							if ($costo->variedad==$variedad) {
							$costopacking+=$costo->total_usd;
							}  
						}
						$totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas;
					@endphp
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
						
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td>{{number_format($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
						
							<td>
							@if ($pesoneto4j)
								{{number_format(($retorno4j*0.92-(($costopacking*($pesoneto4j))/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
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
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td>{{number_format($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j-$flete3j,2,',','.')}} USD</td>
						<td>
							@if ($pesoneto3j)
							{{number_format(($retorno3j*0.92-(($costopacking*($pesoneto3j))/$kgstotmas)-$exportacion3j-$material3j-$flete3j)/$pesoneto3j,2)}} USD/kg
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
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td>{{number_format($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
						<td>
							@if ($pesoneto2j)
								{{number_format(($retorno2j*0.92-(($costopacking*($pesoneto2j))/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
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
						
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td>{{number_format($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
						<td>
							@if ($pesonetoj)
								{{number_format(($retornoj*0.92-(($costopacking*($pesonetoj))/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
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

						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td>{{number_format($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
						<td>
							@if ($pesonetoxl)
								{{number_format(($retornoxl*0.92-(($costopacking*($pesonetoxl))/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
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
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl),2,',','.')}}  USD</td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl))/$kgstotmas)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl)-($material4j+$material3j+$material2j+$materialj+$materialxl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}}  USD/KGS</td>
						
						</tr>
						@endif
						@php
						$semanacount+=1;
						@endphp
						
					@endforeach

					@if ($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl)
						<tr>
						
						<td> </td>
						
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
						
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						
						
						
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($subcantidad4j+$subcantidad3j+$subcantidad2j+$subcantidadj+$subcantidadxl)}}</td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl)}} KGS</td>
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($subretorno4j+$subretorno3j+$subretorno2j+$subretornoj+$subretornoxl)*0.92-(($costopacking*($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl))/$kgstotmas)-($submaterial4j+$submaterial3j+$submaterial2j+$submaterialj+$submaterialxl)-($subexportacion4j+$subexportacion3j+$subexportacion2j+$subexportacionj+$subexportacionxl)-($subflete4j+$subflete3j+$subflete2j+$subfletej+$subfletexl),2,',','.')}}  USD</td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($subretorno4j+$subretorno3j+$subretorno2j+$subretornoj+$subretornoxl)*0.92-(($costopacking*($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl))/$kgstotmas)-($submaterial4j+$submaterial3j+$submaterial2j+$submaterialj+$submaterialxl)-($subexportacion4j+$subexportacion3j+$subexportacion2j+$subexportacionj+$subexportacionxl)-($subflete4j+$subflete3j+$subflete2j+$subfletej+$subfletexl))/($subpesoneto4j+$subpesoneto3j+$subpesoneto2j+$subpesonetoj+$subpesonetoxl),2,',','.')}}  USD/KG</td>
						
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
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($cantidadtotal)}}</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($pesonetototal)}} KG</td>
					{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$globalfletehuerto)/$pesonetototal,2)}} usd/kg</td>
					
				</tr>
				
				</tbody>
		  	</table>

			<div class="page-break"></div>
			<img src="{{asset('image/cabecera.png')}}" style="margin-top: 30px; margin-bottom: 15px;" alt="">
			<h3 style="text-align: center; margin: 0; line-height: 1;">EXPORTACIÓN FUERA DE NORMA</h3>
			<p style="text-align: center; margin: 0; line-height: 1;" >{{$razonsocial->name}}</p>
			
				<table id="balance" style="width:100%; border-collapse: collapse; margin-top: 20px;">
					<thead>
					<tr>
					<th>Especie</th>
					<th>Categoría</th>
					<th>Variedad</th>
					
					<th>Serie</th>
					<th>% Curva<br>
						Calibre </th>
					<th>Cajas</th>
					<th>Peso Neto</th>
					
					<th  class="bg-yellow-100">Retorno Neto<br> Total</th>
					<th class="bg-yellow-100">Retorno Kilo</th>
					</tr>
					</thead>
					<tbody>
					@php
						$variedadcount=1;
						$supercantidadtotal=0;
						$superpesonetototal=0;
						$superretornototal=0;
						$superexportaciontotal=0;
						$globalfletehuerto=0;
						$supertotalmateriales=0;
						$supertotalcostopacking=0;
						@endphp
					@foreach ($unique_categorias as $categoria)
						@php
						$fletehuerto=0;
						$totalcostopacking=0;
						$variedadcount=1;
						$cantidadtotal=0;
						$pesonetototal=0;
						$retornototal=0;
						$exportaciontotal=0;
						$totalmateriales=0;
						$kgsglobmas=0;

							$subflete4j=0;
							$subflete3j=0;
							$subflete2j=0;
							$subfletej=0;
							$subfletexl=0;
							$subfletel=0;

						@endphp

						@foreach ($unique_variedades as $variedad)
						@php
							$costopacking=0;
							$calibrecount=1;
							
							$cantidad4j=0;
							$cantidad3j=0;
							$cantidad2j=0;
							$cantidadj=0;
							$cantidadxl=0;
							$cantidadl=0;

							$exportacion4j=0;
							$exportacion3j=0;
							$exportacion2j=0;
							$exportacionj=0;
							$exportacionxl=0;
							$exportacionl=0;
			
							$pesoneto4j=0;
							$pesoneto3j=0;
							$pesoneto2j=0;
							$pesonetoj=0;
							$pesonetoxl=0;
							$pesonetol=0;
			
							$retorno4j=0;
							$retorno3j=0;
							$retorno2j=0;
							$retornoj=0;
							$retornoxl=0;
							$retornol=0;

							$flete4j=0;
							$flete3j=0;
							$flete2j=0;
							$fletej=0;
							$fletexl=0;
							$fletel=0;

							$material4j=0;
							$material3j=0;
							$material2j=0;
							$materialj=0;
							$materialxl=0;
							$materiall=0;

							$kgstotmas=0;
						@endphp
				
						@foreach ($masas as $masa)
							@if (($masa->n_etiqueta=='Loica' || $masa->n_calibre=='L' || $masa->n_calibre=='LD') && $masa->n_categoria==$categoria && $categoria!='Vega')
							
							@if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad)
								@php
								$cantidad4j+=$masa->cantidad;
								$pesoneto4j+=$masa->peso_neto;
									$retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacion4j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacion4j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$material4j+=$masa->cantidad*$material->costo_por_caja_usd;
											$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
											$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										}  
									}
									foreach ($fletestotal as $flete) {
										if ($flete->rut==$masa->r_productor) {
										$flete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subflete4j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										}  
									}
								@endphp	
								
							@endif
							@if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad)
								@php
								$cantidad3j+=$masa->cantidad;
								$pesoneto3j+=$masa->peso_neto;
									$retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacion3j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacion3j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$material3j+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
										if ($flete->rut==$masa->r_productor) {
										$flete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subflete3j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										}  
									}
								@endphp	
							@endif
							@if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad)
								@php
								$cantidad2j+=$masa->cantidad;
								$pesoneto2j+=$masa->peso_neto;
									$retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacion2j+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacion2j+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$material2j+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
										if ($flete->rut==$masa->r_productor) {
										$flete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subflete2j+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										}  
									}
								@endphp	
							@endif
							@if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad)
								@php
								$cantidadj+=$masa->cantidad;
									$pesonetoj+=$masa->peso_neto;
									$retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacionj+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacionj+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$materialj+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
										if ($flete->rut==$masa->r_productor) {
										$fletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subfletej+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										}  
									}
								@endphp	
							@endif
							@if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad)
								@php
								$cantidadxl+=$masa->cantidad;
								$pesonetoxl+=$masa->peso_neto;
									$retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
								$cantidadtotal+=$masa->cantidad;
								$pesonetototal+=$masa->peso_neto;
								if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
										$exportacionxl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
								if ($masa->tipo_transporte=='MARITIMO') {
									if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacionxl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
									}
									}
									foreach ($materialestotal as $material) {
									if ($material->c_embalaje==$masa->c_embalaje) {
										$materialxl+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
									}  
									}
									foreach ($fletestotal as $flete) {
										if ($flete->rut==$masa->r_productor) {
										$fletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subfletexl+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										}  
									}
								@endphp	
							@endif
							@if (($masa->n_calibre=='L' || $masa->n_calibre=='LD') && $masa->n_variedad==$variedad)
								@php
									$cantidadl+=$masa->cantidad;
									$pesonetol+=$masa->peso_neto;
									$retornol+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
									$cantidadtotal+=$masa->cantidad;
									$pesonetototal+=$masa->peso_neto;
									if ($masa->tipo_transporte=='AEREO') {
										if ($exportacions->where('type','aereo')->count()>0) {
											$exportacionl+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
											$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
											$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','aereo')->first()->precio_usd;
										}
									}
									if ($masa->tipo_transporte=='MARITIMO') {
										if ($exportacions->where('type','maritimo')->count()>0) {
										$exportacionl+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$exportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										$superexportaciontotal+=$masa->peso_neto*$exportacions->where('type','maritimo')->first()->precio_usd;
										}
									}
									foreach ($materialestotal as $material) {
										if ($material->c_embalaje==$masa->c_embalaje) {
										$materiall+=$masa->cantidad*$material->costo_por_caja_usd;
										$totalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										$supertotalmateriales+=$masa->cantidad*$material->costo_por_caja_usd;
										}  
									}
									foreach ($fletestotal as $flete) {
										if ($flete->rut==$masa->r_productor) {
										$fletel+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$subfletel+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$fletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										$globalfletehuerto+=floatval($masa->peso_neto)*floatval($flete->tarifa);
										}  
									}
								@endphp	
									
							@endif
							
							@endif
							
						@endforeach
						
						@foreach ($masas as $masa)
							@php
							if ($masa->n_variedad==$variedad) {
								$kgstotmas+=$masa->peso_neto;
								$kgsglobmas+=$masa->peso_neto;
							}
							@endphp
						@endforeach
						@php
							foreach ($packings as $costo) {
							if ($costo->variedad==$variedad) {
								$costopacking+=$costo->total_usd;
							
							}  
							}
							$totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas;
							$supertotalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas;
						@endphp
			
						@if (($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol)>0)
							
							
							@if (($unique_calibres->contains('4J') || $unique_calibres->contains('4JD') || $unique_calibres->contains('4JDD')) && $pesoneto4j>0)
								<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$categoria}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								
								
								
								
								<td>4J</td>
								@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
									<td>{{number_format($cantidad4j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
								@else
									<td>0</td>
								@endif
									
								<td>{{$cantidad4j}}</td>
								<td>{{$pesoneto4j}} KGS</td>
								{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
								<td>{{number_format($retorno4j*0.92-(($costopacking*$pesoneto4j)/$kgstotmas)-$exportacion4j-$material4j-$flete4j,2,',','.')}} USD</td>
								<td>
									@if ($pesoneto4j)
									{{number_format(($retorno4j*0.92-(($costopacking*$pesoneto4j)/$kgstotmas)-$exportacion4j-$material4j-$flete4j)/$pesoneto4j,2)}} USD/kg
									@else
									0 USD/kg
									@endif
								</td>
								
								</tr>
								@php
								$calibrecount+=1;
								@endphp
							@endif
							
							@if (($unique_calibres->contains('3J') || $unique_calibres->contains('3JD') || $unique_calibres->contains('3JDD')) && $pesoneto3j>0)
								<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$categoria}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								
								
								
								<td>3J</td>
								@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
									<td>{{number_format($cantidad3j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
								@else
									<td>0</td>	
								@endif
			
								<td>{{$cantidad3j}}</td>
								<td>{{$pesoneto3j}} KGS</td>
								{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
								<td>{{number_format($retorno3j*0.92-(($costopacking*$pesoneto3j)/$kgstotmas)-$exportacion3j-$material3j-$flete3j,2,',','.')}} USD</td>
								<td>
									@if ($pesoneto3j)
									{{number_format(($retorno3j*0.92-(($costopacking*$pesoneto3j)/$kgstotmas)-$exportacion3j-$material3j-$flete3j)/$pesoneto3j,2)}} USD/kg
									@else
									0 USD/kg
									@endif
								</td>
								
								</tr>
								@php
								$calibrecount+=1;
								@endphp
							@endif
							
							@if (($unique_calibres->contains('2J') || $unique_calibres->contains('2JD') || $unique_calibres->contains('2JDD')) && $pesoneto2j>0)
								<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$categoria}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								
								
								
								<td>2J</td>
			
								@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
									<td>{{number_format($cantidad2j*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
								@else
									<td>0</td>
								@endif
								
								<td>{{$cantidad2j}}</td>
								<td>{{$pesoneto2j}} KGS</td>
								{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
								<td>{{number_format($retorno2j*0.92-(($costopacking*$pesoneto2j)/$kgstotmas)-$exportacion2j-$material2j-$flete2j,2,',','.')}} USD</td>
							
								<td>
									@if ($pesoneto2j)
									{{number_format(($retorno2j*0.92-(($costopacking*$pesoneto2j)/$kgstotmas)-$exportacion2j-$material2j-$flete2j)/$pesoneto2j,2)}} USD/kg
									@else
									0 USD/kg
									@endif
								</td>
								
								</tr>
								@php
								$calibrecount+=1;
								@endphp
							@endif
							
							@if (($unique_calibres->contains('J') || $unique_calibres->contains('JD') || $unique_calibres->contains('JDD')) && $pesonetoj>0)
								<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$categoria}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								
								
								
								
								<td>J</td>
								@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
									<td>{{number_format($cantidadj*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
								@else
									<td>0</td>
								@endif
								
								<td>{{$cantidadj}}</td>
								<td>{{$pesonetoj}} KGS</td>
								{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
								<td>{{number_format($retornoj*0.92-(($costopacking*$pesonetoj)/$kgstotmas)-$exportacionj-$materialj-$fletej,2,',','.')}} USD</td>
								<td>
									@if ($pesonetoj)
									{{number_format(($retornoj*0.92-(($costopacking*$pesonetoj)/$kgstotmas)-$exportacionj-$materialj-$fletej)/$pesonetoj,2)}} USD/kg
									@else
									0 USD/kg
									@endif
								</td>
					
								
								</tr>
								@php
								$calibrecount+=1;
								@endphp
							@endif
							
							@if (($unique_calibres->contains('XL') || $unique_calibres->contains('XLD') || $unique_calibres->contains('XLDD')) && $pesonetoxl>0)
								<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$categoria}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								
								
								
								
								<td>XL</td>
								@if (($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl)>0)
									<td>{{number_format($cantidadxl*100/($cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl),2)}}%</td>
								@else
									<td>0</td>	
								@endif
			
								<td>{{$cantidadxl}}</td>
								<td>{{$pesonetoxl}} KGS</td>
								{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
								<td>{{number_format($retornoxl*0.92-(($costopacking*$pesonetoxl)/$kgstotmas)-$exportacionxl-$materialxl-$fletexl,2,',','.')}} USD</td>
							
								<td>
									@if ($pesonetoxl)
									{{number_format(($retornoxl*0.92-(($costopacking*$pesonetoxl)/$kgstotmas)-$exportacionxl-$materialxl-$fletexl)/$pesonetoxl,2)}} USD/kg
									@else
									0 USD/kg
									@endif
								</td>
								
								</tr>
								@php
								$calibrecount+=1;
								@endphp
							@endif
							
							@if (($unique_calibres->contains('L') || $unique_calibres->contains('LD')) && $pesonetol>0)
								<tr>
								@if ($variedadcount==1 && $calibrecount==1)
									<td>Cherries</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$categoria}}</td>
								@else
									<td> </td>
								@endif
								@if ($calibrecount==1)
									<td>{{$variedad}}</td>
								@else
									<td> </td>
								@endif
								
								
								
								
								<td>L</td>
								@if (($cantidadl+$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl)>0)
									<td>{{number_format($cantidadl*100/($cantidadl+$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl),2)}}%</td>
								@else
									<td>0</td>	
								@endif
			
								<td>{{$cantidadl}}</td>
								<td>{{$pesonetol}} KGS</td>
								{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
								<td>{{number_format($retornol*0.92-(($costopacking*$pesonetol)/$kgstotmas)-$exportacionl-$materiall-$fletel,2,',','.')}} USD</td>
							
								<td>
									@if ($pesonetol)
									{{number_format(($retornol*0.92-(($costopacking*$pesonetol)/$kgstotmas)-$exportacionl-$materiall-$fletel)/$pesonetol,2)}} USD/kg
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
								<td> </td>
							
							
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
								
								
								
								
								
								
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">100,00%</td>
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidad4j+$cantidad3j+$cantidad2j+$cantidadj+$cantidadxl+$cantidadl}}</td>
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol}} KGS</td>
								{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas)-($material4j+$material3j+$material2j+$materialj+$materialxl+$materiall)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl+$exportacionl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl+$fletel),2,',','.')}} USD</td>
							
								@if (($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol)>0)
								<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format((($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl+$retornol)*0.92-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol))/$kgstotmas)-($material4j+$material3j+$material2j+$materialj+$materialxl+$materiall)-($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl+$exportacionl)-($flete4j+$flete3j+$flete2j+$fletej+$fletexl+$fletel))/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl+$pesonetol),2)}} USD/KG</td>
								@else
								<td>0</td>	
								@endif
							</tr>
							
				
							@php
							$variedadcount+=1;
							
						
							$supercantidadtotal+=$cantidadtotal;
							$superpesonetototal+=$pesonetototal;
							$superretornototal+=$retornototal; 
						
							@endphp
						
						@endif
				
						@endforeach
			
						@if (($cantidadtotal+$pesonetototal)>0)
						<tr>
								
							
							<td></td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$categoria}}</td>
							
							
							
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
						
							
							
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidadtotal}}</td>
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
							{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92-($totalcostopacking)-$exportaciontotal-$totalmateriales-$fletehuerto,2,',','.')}} USD</td>
							
							@if ($pesonetototal>0)
							<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal/$pesonetototal,2)}} usd/kg</td>
							@else
							<td>0</td>
							@endif
						</tr>
						@endif
			
					@endforeach
			
					<tr>
								
							
							
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
						
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
					
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"> </td>
					
						
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$supercantidadtotal}}</td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$superpesonetototal}} KGS</td>
						{{-- Retorno - Comision - CostoPacking -Exportacion- Material -Flete --}}
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal*0.92-($supertotalcostopacking)-$superexportaciontotal-$supertotalmateriales-$globalfletehuerto,2,',','.')}} USD</td>
						@if ($superpesonetototal>0)
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($superretornototal/$superpesonetototal,2)}} usd/kg</td>
						@else
						<td>0</td>
						@endif
					</tr>
			
					</tbody>
				</table>

			<div class="page-break"></div>
			<img src="{{asset('image/cabecera.png')}}" style="margin-top: 30px; margin-bottom: 15px;" alt="">
			<h3 style="text-align: center; margin: 0; line-height: 1;">FRUTA COMERCIAL</h3>
			<p style="text-align: center; margin: 0; line-height: 1;" >{{$razonsocial->name}}</p>

			<table id="balance" style="width:70%; border-collapse: collapse; margin-top: 20px;">
				<thead>
				  <tr>
				  
				  <th>Variedad</th>
				  
				  <th>Serie</th>
				  
				
				  <th>Peso Neto</th>
				  <th>Ingreso Comercial</th>
				  
				  </tr>
				</thead>
				<tbody>
				  @php
					$variedadcount=1;
					$cantidadtotal=0;
					$pesonetototal=0;
					$retornototal=0;
					$totalcostopacking=0;
					$kgsglobmas=0;
				  @endphp
				  @foreach ($unique_variedades as $variedad)
					@php
					  $calibrecount=1;
					  $costopacking=0;
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
					  $kgstotmas=0;
					@endphp
		  
					@foreach ($masas as $masa)
					  @if ($masa->n_calibre=='Comercial' || $masa->n_calibre=='Precalibre' || $masa->n_calibre=='Desecho' || $masa->n_calibre=='Merma')
						@if (($masa->n_calibre=='Comercial') && $masa->n_variedad==$variedad)
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
						@if (($masa->n_calibre=='Precalibre') && $masa->n_variedad==$variedad)
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
						@if (($masa->n_calibre=='Desecho') && $masa->n_variedad==$variedad)
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
						@if (($masa->n_calibre=='Merma') && $masa->n_variedad==$variedad)
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
						
						
					  @endif
					  
					@endforeach
					@foreach ($masas as $masa)
					  @php
						if ($masa->n_variedad==$variedad) {
							$kgstotmas+=$masa->peso_neto;
							$kgsglobmas+=$masa->peso_neto;
						}
					  @endphp
					@endforeach
					  @php
						foreach ($packings as $costo) {
						  if ($costo->variedad==$variedad) {
							$costopacking+=$costo->total_usd;
						  }  
						}
						$totalcostopacking+=($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj))/$kgstotmas;
					 
					  @endphp
		  
						<tr>
						  
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  
						  
						  
						  <td>Comercial</td>
						  
						  <td>{{$pesoneto4j}} KGS</td>
						   {{-- Retorno - CostoPacking --}}
						  <td>{{number_format($retorno4j-($costopacking*$pesoneto4j)/$kgstotmas,2,',','.')}} USD</td>
						  
						  
						</tr>
						@php
						  $calibrecount+=1;
						@endphp
						<tr>
						  
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  
						  
						  <td>Precalibre</td>
						  
						  
						  <td>{{$pesoneto3j}} KGS</td>
						   {{-- Retorno - CostoPacking --}}
						  <td>{{number_format($retorno3j-($costopacking*$pesoneto3j)/$kgstotmas,2,',','.')}} USD</td>
						  
						  
						</tr>
						@php
						  $calibrecount+=1;
						@endphp
						<tr>
						
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  
						  
						  <td>Desecho</td>
						  
						
						  <td>{{$pesoneto2j}} KGS</td>
						   {{-- Retorno - CostoPacking --}}
						  <td>{{number_format($retorno2j-($costopacking*$pesoneto2j)/$kgstotmas,2,',','.')}} USD</td>
						  
						  
						</tr>
						@php
						  $calibrecount+=1;
						@endphp
				  
						<tr>
						
						  @if ($calibrecount==1)
							<td>{{$variedad}}</td>
						  @else
							<td> </td>
						  @endif
						  
						  
						  
						  <td>Merma</td>
						  
						
						  <td>{{$pesonetoj}} KGS</td>
						   {{-- Retorno - CostoPacking --}}
						  <td>{{number_format($retornoj-(($costopacking*$pesonetoj)/$kgstotmas),2,',','.')}} USD</td>
						  
						  
						</tr>
						@php
						  $calibrecount+=1;
						@endphp
					
		
					  
		  
					  <tr>
						
						  
					  
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total {{$variedad}}</td>
						
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj}}</td>
						 {{-- Retorno - CostoPacking --}}
						<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retorno4j+$retorno3j+$retorno2j+$retornoj-(($costopacking*($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj))/$kgstotmas),2,',','.')}} USD</td>
						
					  </tr>
					  
		  
					  @php
						$variedadcount+=1;
					  @endphp
					
		  
				  @endforeach
		  
				  <tr>
						
					
				  
					  <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">Total</td>
					
					
					
					
					
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;"></td>
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
					{{-- Retorno - CostoPacking --}}
					<td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal-($totalcostopacking),2,',','.')}} USD</td>
				 
				  </tr>
					  
		  
				</tbody>
			</table>
		
	</body>
</html>