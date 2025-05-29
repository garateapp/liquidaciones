<table>
    <thead>
        <tr>
            <th>PRODUCTOR</th>
            @foreach($condiciones as $condicion)
                <th>RESPUESTA {{ $condicion->id }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($razons as $razon)
            <tr>
                <td>{{ $razon->name }}</td>
                @foreach($condiciones as $condicion)
                    @php
                        $opcionIds = $condicion->opcions->pluck('id')->toArray();
                        $respuesta = $razon->respuestas->first(fn($r) => in_array($r->opcion_condicion_id, $opcionIds));
                    @endphp
                    <td>{{ $respuesta ? $respuesta->opcion_condicion->text : 'Seleccione una opción' }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>

</table>
