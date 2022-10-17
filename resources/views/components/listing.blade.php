<div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Matrícula</th>
            <th>Color</th>
            <th>Operaciones</th>
        </tr>
        @forelse ($bikes as $bike)
            <tr>
                <td>{{ $bike->id }}</td>
                <td class="text-center" style="max-width: 80px">
                    <img class="rounded" style="max-width: 80%" alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                        title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                        src="{{ asset('storage/' . config('filesystems.bikesImageDir')) . '/' . ($bike->imagen ?? 'default.png') }}">
                </td>
                <td>{{ $bike->marca }}</td>
                <td>{{ $bike->modelo }}</td>
                <td>{{ $bike->matricula }}</td>
                <td
                    style="background-color: {{ $bike->color }}; {{ App\Http\Controllers\BikeController::whiteText($bike->color) }}">
                    {{ $bike->color }}
                </td>
                <td class="text-center">
                    <a class="text-decoration-none" href="{{ route('bikes.show', $bike->id) }}">
                        <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}"
                            alt="Ver detaller" title="Ver detalles">
                    </a>
                    @auth
                        @can('update', $bike)
                            <a class="text-decoration-none" href="{{ route('bikes.edit', $bike->id) }}">
                                <img height="20" width="20" src="{{ asset('images/buttons/edit.png') }}" alt="Modificar"
                                    title="Modificar">
                            </a>
                        @endcan
                        @can('delete', $bike)
                            <a class="text-decoration-none" href="{{ route('bikes.delete', $bike->id) }}">
                                <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}"
                                    alt="Borrar" title="Borrar">
                            </a>
                        @endcan
                    @endauth
                </td>
            </tr>
            @if ($loop->last)
                <tr>
                    <td colspan="7">Mostrando {{ sizeof($bikes) }} de {{ $bikes->total() }}</td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="7">No hay resultados que mostrar.</td>
            </tr>
        @endforelse
    </table>

    <div class="row">
        <div class="col-6 text-start">{{ $bikes->links() }}</div>
    </div>
</div>
