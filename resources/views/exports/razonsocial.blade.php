<table>
    <thead>
        <tr>
            <th>PRODUCTOR</th>
            <th>FACTOR</th>
            <th>RESPUESTA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($razons as $razon)
            @php
                $opcionIds = $costo->condicionproductor->opcions->pluck('id')->toArray();
                $respuestasFiltradas = $razon->respuestas->filter(fn($r) => in_array($r->opcion_condicion_id, $opcionIds));
            @endphp

            @if($respuestasFiltradas->isEmpty())
                <tr>
                    <td>{{ $razon->name }}</td>
                    <td>Seleccione una opción</td>
                    <td>n/a</td>
                </tr>
            @else
                @foreach($respuestasFiltradas as $respuesta)
                    <tr>
                        <td>{{ $razon->name }}</td>
                        <td>{{ $respuesta->opcion_condicion->value }}</td>
                        <td>{{ $respuesta->opcion_condicion->text }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>
