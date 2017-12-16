{!! $filters->render() !!}

<table {!! $attrs !!}>

    <thead>
        <tr>
            @foreach($columns as $column)
                @includeWhen($column->visible(), 'administr/listview::_column')
            @endforeach
        </tr>
    </thead>

    <tbody>
        @forelse($values as $row)
            @include('administr/listview::_row')
        @empty
            <td colspan="{{ count($columns) }}">{{ config('administr.listview.empty') }}</td>
        @endforelse
    </tbody>

    <tfoot>
        <tr>
            @foreach($columns as $column)
                @includeWhen($column->visible(), 'administr/listview::_column')
            @endforeach
        </tr>

        @if($paginationLinks)
            <tr>
                <td colspan="{{ count($columns) }}">
                    {!! $paginationLinks !!}
                </td>
            </tr>
        @endif
    </tfoot>
</table>