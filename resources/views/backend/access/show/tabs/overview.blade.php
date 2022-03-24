<table class="table table-striped table-hover">
    <tr>
        <th>Imię</th>
        <td>{{ $user->first_name .' '. $user->last_name }}</td>
    </tr>

    <tr>
        <th>Nazwisko</th>
        <td>{{ $user->email }}</td>
    </tr>

    <tr>
        <th>Aktywny?</th>
        <td>{!! $user->confirmed_label !!}</td>
    </tr>

    <tr>
        <th>Utworzony</th>
        <td>{{ $user->created_at }} ({{ $user->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>Ostatnia modyfikacja</th>
        <td>{{ $user->updated_at }} ({{ $user->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($user->trashed())
        <tr>
            <th>Usunięty</th>
            <td>{{ $user->deleted_at }} ({{ $user->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>