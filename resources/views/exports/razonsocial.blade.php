<table>
    <thead>
        <tr>
            <th>PRODUCTOR</th>
            @if(isset($condiciones))
                @foreach($condiciones as $condicion)
                    <th>Condición {{ $condicion->id }}</th>
                @endforeach
            @else
                <th>FACTOR</th>
                <th>RESPUESTA</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($razons as $razon)
            <tr>
                <td>{{ $razon->name }}</td>

                @if(isset($condiciones))
                    @foreach($condiciones as $condicion)
                        @php
                            $opcionIds = $condicion->opcions->pluck('id')->toArray();
                            $respuesta = $razon->respuestas->first(fn($r) => in_array($r->opcion_condicion_id, $opcionIds));
                        @endphp
                        <td>{{ $respuesta ? $respuesta->opcion_condicion->value : 'n/a' }}</td>
                    @endforeach
                @else
                    @php
                        $opcionIds = $costo->condicionproductor->opcions->pluck('id')->toArray();
                        $respuesta = $razon->respuestas->first(fn($r) => in_array($r->opcion_condicion_id, $opcionIds));
                    @endphp
                    <td>{{ $respuesta ? $respuesta->opcion_condicion->value : 'Seleccione una opción' }}</td>
                    <td>{{ $respuesta ? $respuesta->opcion_condicion->text : 'n/a' }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
