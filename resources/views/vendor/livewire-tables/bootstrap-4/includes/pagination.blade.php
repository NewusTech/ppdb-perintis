@if ($showPagination)
    @if ($paginationEnabled && $rows->lastPage() > 1)
        <div class="mt-3 row">
            <div class="overflow-auto col-12 col-md-6">
                {{ $rows->links() }}
            </div>

            <div class="text-center col-12 col-md-6 text-md-right text-muted">
                <span>@lang('Showing')</span>
                <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                <span>@lang('to')</span>
                <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                <span>@lang('of')</span>
                <strong>{{ $rows->total() }}</strong>
                <span>@lang('results')</span>
            </div>
        </div>
    @else
        <div class="mt-3 row">
            <div class="col-12 text-muted">
                @lang('Showing')
                <strong>{{ $rows->count() }}</strong>
                @lang('results')
            </div>
        </div>
    @endif
@endif
