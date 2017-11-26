<div class="administr-filters">
    <form>
        {!! $builder->render() !!}

        {!! $filterBtn->render() !!}
        <a href="{{ $clearBtn['url'] }}">
            {{ $clearBtn['label'] }}
        </a>
    </form>
</div>