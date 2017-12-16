<div style="padding: 20px;">
    <form>
        @foreach(collect($builder->fields())->chunk(3) as $fields)
            <div class="row">
                @foreach($fields as $field)
                    <div class="col-sm-4">
                        {!! $field->render() !!}
                    </div>
                @endforeach
            </div>
        @endforeach
        <div class="row">
            <div class="col-sm-12">
                {!! $filterBtn->render() !!}
                <a href="{{ $clearBtn['url'] }}" class="btn btn-default">
                    {{ $clearBtn['label'] }}
                </a>
            </div>
        </div>
    </form>
</div>