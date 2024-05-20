@if ($showFilterDropdown && ($filtersView || count($customFilters)))
    <div class="mb-3 mb-md-0" id="{{ $filterKey = \Illuminate\Support\Str::random() }}-filters">
        <div class="dropdown d-block d-md-inline">
            <button class="btn btn-info dropdown-toggle d-block w-100 d-md-inline" type="button"
                id="{{ $filterKey }}-filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('Filters')

                @if (count($this->getFiltersWithoutSearch()))
                    <span class="badge badge-success">
                        {{ count($this->getFiltersWithoutSearch()) }}
                    </span>
                @endif

                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu mt-3" style="overflow-y: auto; max-height: 300px;"
                aria-labelledby="{{ $filterKey }}-filter">
                <li class="dropdown-item">
                    @if ($filtersView)
                        @include($filtersView)
                    @elseif (count($customFilters))
                        @foreach ($customFilters as $key => $filter)
                            <div wire:key="filter-{{ $key }}" class="p-2">
                                <label for="filter-{{ $key }}" class="mb-2">
                                    {{ $filter->name() }}
                                </label>

                                @if ($filter->isSelect())
                                    @include('livewire-tables::bootstrap-4.includes.filter-type-select')
                                @elseif($filter->isMultiSelect())
                                    @include('livewire-tables::bootstrap-4.includes.filter-type-multiselect')
                                @elseif($filter->isDate())
                                    @include('livewire-tables::bootstrap-4.includes.filter-type-date')
                                @elseif($filter->isDatetime())
                                    @include('livewire-tables::bootstrap-4.includes.filter-type-datetime')
                                @endif
                            </div>
                        @endforeach
                    @endif

                    @if (count($this->getFiltersWithoutSearch()))
                        <div class="dropdown-divider"></div>
                        <button wire:click.prevent="resetFilters" x-on:click="open = false"
                            class="text-center dropdown-item btn">
                            @lang('Clear')
                        </button>
                    @endif
                </li>
            </ul>
        </div>
    </div>
@endif
