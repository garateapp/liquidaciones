<table>
    <thead>
        <tr>
            <th>Código Embalaje</th>
            <th>Costo por caja (USD)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registros as $r)
            <tr>
                <td>{{ $r->c_embalaje }}</td>
                <td>{{ $r->costo_por_caja ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
