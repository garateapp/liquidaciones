<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Filtros') }}
        </h2>
    </x-slot>
    
    <div class="pb-8 pt-2">
    
      <div class="card">
        <div class="px-2 md:px-6 py-4">
        

          <h1 class="text-2xl font-bold">Temporada {{$temporada->name}}</h1>
          <hr class="mt-2 mb-6">
          <div class="flex w-full bg-gray-300" x-data="{openMenu:2}" >
              
              @livewire('menu-aside',['temporada'=>$temporada->id])

              <div class="pb-12 pt-6 w-full">
                  <div class="mx-auto sm:px-6 lg:px-8">
                      <div class="flex justify-between mb-6">
                        <div class="items-center"> 
                          <h2 @click.on="openMenu = 1"  class="cursor-pointer text-xs text-blue-500 font-semibold mb-4"><-Abrir Menu</h2>
                        </div>

                        <a href="{{route('exportpdff',['razonsocial'=>$razonsocial,'temporada'=>$temporada])}}" target="_blank">
                          <x-button>
                            Generar
                          </x-button>
                        </a>
                  
                      </div>
                      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                          <div class="flex flex-col">
                              <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                  <div class="overflow-hidden">
                                    <table class="min-w-full">
                                      <thead class="bg-white border-b">
                                        <tr>
                                          <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                          </th>
                                          <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Name
                                          </th>
                                          <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Rut
                                          </th>
                                          <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Csg
                                          </th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                              <tr class="bg-gray-100 border-b">
                                                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$razonsocial->id}}</td>
                                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                  {{$razonsocial->name}}
                                                  </td>
                                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                  {{$razonsocial->rut}}
                                                  </td>
                                                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                  {{$razonsocial->csg}}
                                                  </td>
                                              </tr>
                                        
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <div class="flex flex-col">
                            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                              <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">

                         
                                

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
                                      <th>Ingresos</th>
                                      <th>Comision</th>
                                      <th>Frio<br>Packing</th>
                                      <th>Exportacion</th>
                                      <th>Flete a <br> Puerto</th>
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
                                        $exportaciontotal=0;
                                        $totalcostopacking=0;
                                        $globalfletehuerto=0;

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
                                                @endphp	
                                            @endif
                                            @php
                                                 foreach ($fletestotal as $flete) {
                                                    if (preg_replace('/[\.\-\s]+/', '', strtolower($flete->rut))==preg_replace('/[\.\-\s]+/', '', strtolower($masa->r_productor))) {
                                                      $fletehuerto+=float_val($masa->peso_neto)*float_val($flete->tarifa);
                                                      $globalfletehuerto+=float_val($masa->peso_neto)*float_val($flete->tarifa);
                                                    }  
                                                  }
                                            @endphp
                                          @endif
                                        @endforeach
                                        @php
                                          foreach ($packings as $costo) {
                                            if ($costo->variedad==$variedad) {
                                              $costopacking+=$costo->total_usd;
                                              $totalcostopacking+=$costo->total_usd;
                                            }  
                                          }
                                         
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
                                              <td>{{number_format($retorno4j,2,',','.')}} USD</td>
                                              <td>{{number_format($retorno4j*0.08,2,',','.')}} USD</td>
                                              <td>{{number_format($costopacking,2,',','.')}} USD</td>
                                              <td>{{number_format($exportacion4j,2,',','.')}} USD</td>
                                              <td>{{number_format($fletehuerto,2,',','.')}} USD</td>
                                              <td>{{number_format($retorno4j*0.92,2,',','.')}} USD</td>
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
                                              <td>{{number_format($retorno3j,2,',','.')}} USD</td>
                                              <td>{{number_format($retorno3j*0.08,2,',','.')}} USD</td>
                                              <td>{{number_format($costopacking,2,',','.')}} USD</td>
                                              <td>{{number_format($exportacion3j,2,',','.')}} USD</td>
                                              <td>{{number_format($fletehuerto,2,',','.')}} USD</td>
                                              <td>{{number_format($retorno3j*0.92,2,',','.')}} USD</td>
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
                                              <td>{{number_format($retorno2j,2,',','.')}} USD</td>
                                              <td>{{number_format($retorno2j*0.08,2,',','.')}} USD</td>
                                              <td>{{number_format($costopacking,2,',','.')}} USD</td>
                                              <td>{{number_format($exportacion2j,2,',','.')}} USD</td>
                                              <td>{{number_format($fletehuerto,2,',','.')}} USD</td>
                                              <td>{{number_format($retorno2j*0.92,2,',','.')}} USD</td>
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
                                              <td>{{number_format($retornoj,2,',','.')}} USD</td>
                                              <td>{{number_format($retornoj*0.08,2,',','.')}} USD</td>
                                              <td>{{number_format($costopacking,2,',','.')}} USD</td>
                                              <td>{{number_format($exportacionj,2,',','.')}} USD</td>
                                              <td>{{number_format($fletehuerto,2,',','.')}} USD</td>
                                              <td>{{number_format($retornoj*0.92,2,',','.')}} USD</td>
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
                                              <td>{{number_format($retornoxl,2,',','.')}} USD</td>
                                              <td>{{number_format($retornoxl*0.08,2,',','.')}} USD</td>
                                              <td>{{number_format($costopacking,2,',','.')}} USD</td>
                                              <td>{{number_format($exportacionxl,2,',','.')}} USD</td>
                                              <td>{{number_format($fletehuerto,2,',','.')}} USD</td>
                                              <td>{{number_format($retornoxl*0.92,2,',','.')}} USD</td>
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
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl),2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.08,2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($costopacking),2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($exportacion4j+$exportacion3j+$exportacion2j+$exportacionj+$exportacionxl),2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($fletehuerto),2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)*0.92,2,',','.')}} USD</td>
                                            <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($retorno4j+$retorno3j+$retorno2j+$retornoj+$retornoxl)/($pesoneto4j+$pesoneto3j+$pesoneto2j+$pesonetoj+$pesonetoxl),2)}} USD/KG</td>
                                            
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
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$cantidadtotal}}</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{$pesonetototal}} KGS</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.08,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($totalcostopacking,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($exportaciontotal,2,',','.')}} USD</td>
                                        
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format(($globalfletehuerto),2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal*0.92,2,',','.')}} USD</td>
                                        <td style="border-top: 2px solid black; border-bottom: 2px solid black; padding-bottom: 4px; margin-top: 10px; font-weight: bold;">{{number_format($retornototal/$pesonetototal,2)}} usd/kg</td>
                                        
                                      </tr>
                           
                              
                                    </tbody>
                                  </table>

                                  <table id="balance" style="width:100%; border-collapse: collapse; margin-top: 15px;">
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
                                          @if ($masa->n_etiqueta!='Loica' || $masa->n_categoria=='Cat 1')
                                          @if (($masa->n_calibre=='4J' || $masa->n_calibre=='4JD' || $masa->n_calibre=='4JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                            @php
                                            $cantidad4j+=$masa->cantidad;
                                            $pesoneto4j+=$masa->peso_neto;
                                              $retorno4j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                              $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                            $cantidadtotal+=$masa->cantidad;
                                            $pesonetototal+=$masa->peso_neto;
                                            @endphp	
                                          @endif
                                          @if (($masa->n_calibre=='3J' || $masa->n_calibre=='3JD' || $masa->n_calibre=='3JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                            @php
                                            $cantidad3j+=$masa->cantidad;
                                            $pesoneto3j+=$masa->peso_neto;
                                              $retorno3j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                              $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                            $cantidadtotal+=$masa->cantidad;
                                            $pesonetototal+=$masa->peso_neto;
                                            @endphp	
                                          @endif
                                          @if (($masa->n_calibre=='2J' || $masa->n_calibre=='2JD' || $masa->n_calibre=='2JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                            @php
                                            $cantidad2j+=$masa->cantidad;
                                            $pesoneto2j+=$masa->peso_neto;
                                              $retorno2j+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                              $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                            $cantidadtotal+=$masa->cantidad;
                                            $pesonetototal+=$masa->peso_neto;
                                            @endphp	
                                          @endif
                                          @if (($masa->n_calibre=='J' || $masa->n_calibre=='JD' || $masa->n_calibre=='JDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                            @php
                                              $cantidadj+=$masa->cantidad;
                                              $pesonetoj+=$masa->peso_neto;
                                              $retornoj+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                              $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                              $cantidadtotal+=$masa->cantidad;
                                              $pesonetototal+=$masa->peso_neto;
                                            @endphp	
                                          @endif
                                          @if (($masa->n_calibre=='XL' || $masa->n_calibre=='XLD' || $masa->n_calibre=='XLDD') && $masa->n_variedad==$variedad && $masa->semana==$semana)
                                            @php
                                            $cantidadxl+=$masa->cantidad;
                                            $pesonetoxl+=$masa->peso_neto;
                                              $retornoxl+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                              $retornototal+=floatval($masa->peso_neto)*floatval($masa->precio_fob);
                                            $cantidadtotal+=$masa->cantidad;
                                            $pesonetototal+=$masa->peso_neto;
                                            @endphp	
                                          @endif
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

                                  
                                <h1 class="mt-6">
                                  Total venta cerezas exportación temporada 2022-2023 (CAT 1)
                                </h1>
                                <h1 class="mt-2">
                                  Total venta cerezas exportación temporada 2022-2023 (CAT I)
                                </h1>

                                <h1 class="mt-2">
                                  EXPORTACION (CAT1 + CAT I)
                                  NACIONAL (TOTAL - EXPORTACIÓN)
                                </h1>
                                
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
                                        Variedad
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
                                            <p class="text-gray-900 whitespace-no-wrap"> {{$packing->variedad}}</p>
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
                                  Flete a Huerto
                                  </h1>
                                  <table class="min-w-full leading-normal">
                                    <thead>
                                      <tr>
                                        <th
                                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                          Etiqueta
                                        </th>
                                        <th
                                          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Empresa
                                        </th>
                                        <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                      Valor
                                      </th>
                                      <th
                                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    KGS
                                    </th>
                                    
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                          {{$razonsocial->name}}
                                          </th>
                                    
                                      
                                    
                                    </tr>
                                    </thead>
                                    <tbody>
                                  
                                        @foreach ($fletes as $flete)
                                          @php
                                              $total=0;
                                              $totalkgs=0;
                                          @endphp
                                          @foreach ($masas as $masa)
                                          
                                                @if ($flete->etiqueta==$masa->n_etiqueta)
                                                  @php
                                                      $total+=$flete->valor*$masa->peso_neto;
                                                      $totalkgs+=$masa->peso_neto;
                                                  @endphp
                                                @endif
                                          
                                          @endforeach
                                          <tr>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                              <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 hidden">
                                                  <img class="w-full h-full rounded-full"
                                                                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                                            alt="" />
                                                                    </div>
                                                  <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                      {{$flete->etiqueta}}
                                                    </p>
                                                  </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->empresa}}</p>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$flete->valor}}</p>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$totalkgs}}</p>
                                            </td>
                                            <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm text-center">
                                              <p class="text-gray-900 whitespace-no-wrap"> {{$total}}usd</p>
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
                                      Listado de Calibres
                                  </h1>
                                  @foreach ($unique_calibres as $calibre)
                                                                          
                                      {{$calibre}}<br>
                                   
                                  @endforeach

                                  <h1 class="mt-6">
                                    Listado de Variedades
                                  </h1>
                                  @foreach ($unique_variedades as $variedad)
                                                                          
                                      {{$variedad}}<br>
                                   
                                  @endforeach

                                  <h1 class="mt-6">
                                    Listado de Variedades real
                                  </h1>
                                  @foreach ($variedades as $variedad)
                                    <a href="{{Route('grafico.variedad',['razonsocial'=>$razonsocial,'temporada'=>$temporada,'variedad'=>$variedad] )}}" target="_blank">                     
                                      {{$variedad->name}}<br>
                                    </a>
                                  @endforeach

                                

                                  <h1 class="mt-6">
                                    Desglose semanas
                                  </h1>
                                  @foreach ($unique_semanas as $semana)
                                      {{$semana}}<br>
                                  @endforeach
                                  
                                  Precio <br>
                                  SEMANA 1 <br>
                                  Variedad Bing <br>
                                  Calibre 3j <br>

                                  @foreach ($fobs->where('n_variedad','Lapins')->where('semana','1') as $fob)
                                        @if (strpos($fob->n_calibre, "4J") !== false)

                                          {{$fob->semana}} - {{$fob->etiqueta}} - {{$fob->n_calibre}} - {{$fob->color}} - {{$fob->fob_kilo_salida}} (logrado) <br>

                                        @endif
                                  @endforeach

                                
                             
                                
                                  

                                </div>
                              </div>
                            </div>
                      </div>
                  </div>
              </div>
          </div>

        </div>

      </div>
    </div>
    
</x-app-layout>
