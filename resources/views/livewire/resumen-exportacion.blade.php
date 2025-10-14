<div>
  <h1 class="ml-10 mt-2">Categoria: Exportación</h1>

  <table class="divide-y divide-gray-200 border-2 ml-10 w-full max-w-5xl">
    <thead class="bg-white border-b">
      <tr>
        <th class="bg-gray-200 font-semibold px-3 py-2 w-40"></th>
        <th class="bg-gray-200 font-semibold px-3 py-2">Concepto</th>
        <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Totales</th>
        <th class="bg-gray-200 font-semibold px-3 py-2 text-right">Valor Unitario</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td class="bg-gray-200 font-semibold px-3 py-2"></td>
        <td class="bg-gray-200 font-semibold px-3 py-2">Suma de Peso Neto</td>
        <td class="bg-white font-semibold px-3 py-2 text-right">
          {{ number_format($total_kilos, 0, ',', '.') }} kg
        </td>
        <td class="bg-white font-semibold px-3 py-2 text-right">—</td>
      </tr>

      <tr>
        <td class="bg-gray-200 font-semibold px-3 py-2">Ingresos</td>
        <td class="bg-gray-200 font-semibold px-3 py-2">Σ(precio_unitario × peso_neto)</td>
        <td class="bg-white font-semibold px-3 py-2 text-right">
          $ {{ number_format($ingresos_total, 0, ',', '.') }}
        </td>
        <td class="bg-white font-semibold px-3 py-2 text-right">
          $ {{ number_format($vu_promedio, 2, ',', '.') }} /kg
        </td>
      </tr>

      @foreach($this->costosAgrupados as $grupo)
        <tr>
          <td class="bg-gray-200 font-semibold px-3 py-2">Costos</td>
          <td class="bg-gray-200 font-semibold px-3 py-2">{{ $grupo['menu'] }}</td>
          <td class="bg-white font-semibold px-3 py-2"></td>
          <td class="bg-white font-semibold px-3 py-2"></td>
        </tr>

        @foreach($grupo['items'] as $costo)
          @php
            $totalCosto = $this->calcularTotalCosto($costo);
            $vuCosto    = $this->valorUnitarioParaMostrar($costo);
            $isPorCaja  = strtoupper($costo->metodo ?? '') === 'POR_CAJA';
          @endphp
          <tr>
            <td class="bg-gray-100 px-3 py-2"></td>
            <td class="bg-gray-100 px-3 py-2">
              {{ $costo->name }}
              @if($costo->metodo)
                <span class="text-xs text-gray-500">({{ strtoupper($costo->metodo) }})</span>
              @endif
            </td>
            <td class="bg-white px-3 py-2 text-right">
              $ {{ number_format($totalCosto, 0, ',', '.') }}
            </td>
            <td class="bg-white px-3 py-2 text-right">
              $ {{ number_format($vuCosto, 2, ',', '.') }} {{ $isPorCaja ? '/caja' : '/kg' }}
            </td>
          </tr>
        @endforeach
      @endforeach

      <tr class="border-t-2">
        <td class="bg-gray-200 font-bold px-3 py-2">Totales</td>
        <td class="bg-gray-200 font-bold px-3 py-2">Costos</td>
        <td class="bg-white font-bold px-3 py-2 text-right">
          $ {{ number_format($totalCostos, 0, ',', '.') }}
        </td>
        <td class="bg-white font-bold px-3 py-2 text-right">
          @if($total_kilos > 0)
            $ {{ number_format($totalCostos / $total_kilos, 2, ',', '.') }} /kg
          @else
            —
          @endif
        </td>
      </tr>

      <tr>
        <td class="bg-gray-200 font-bold px-3 py-2">Resultado</td>
        <td class="bg-gray-200 font-bold px-3 py-2">Ingresos - Costos</td>
        <td class="bg-white font-bold px-3 py-2 text-right">
          $ {{ number_format($resultado, 0, ',', '.') }}
        </td>
        <td class="bg-white font-bold px-3 py-2 text-right">
          $ {{ number_format($vu_resultado, 2, ',', '.') }} /kg
        </td>
      </tr>
    </tbody>
  </table>
</div>
