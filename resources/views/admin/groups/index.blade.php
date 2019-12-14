@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="main-content--header">
            <a href="{{ route('groups.create') }}" class="main-content--header-actions">
                <i class="fas fa-plus-circle"></i>
            </a>
            <a href="{{ route('groups.assign') }}" class="main-content--header-actions">
                <i class="fas fa-user-graduate"></i>
            </a>
            <a href="{{ route('groups.import') }}" class="main-content--header-actions">
                <i class="fas fa-upload"></i>
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{!! html_entity_decode($message) !!}</p>
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="alert alert-warning">
                <p>{!! html_entity_decode($message) !!}</p>
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-error">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="table" id="groups">
            <h2>{{ __('groups.list') }}</h2>
            <div class="table--filters">
                <div class="field-container">
                    <label for="search">{{ __('common.search') }}</label>
                    <input type="text" id="search" name="search" class="search">
                </div>
            </div>
            <div class="table-container is-visible">
                <table>
                    <caption class="sr-only">{{ __('groups.list') }}</caption>
                    <thead>
                    <tr>
                        <th scope="col">
                            <button class="sort" data-sort="name">
                                {{ __('common.name') }} <i class="fas fa-arrows-alt-v"></i>
                            </button>
                        </th>
                        <th scope="col">
                            <button class="sort" data-sort="teacher">
                                {{ __('common.teacher') }} <i class="fas fa-arrows-alt-v"></i>
                            </button>
                        </th>
                        <th scope="col">
                            <button class="sort" data-sort="start">
                                {{ __('common.date_start') }} <i class="fas fa-arrows-alt-v"></i>
                            </button>
                        </th>
                        <th scope="col">
                            <button class="sort" data-sort="end">
                                {{ __('common.date_end') }} <i class="fas fa-arrows-alt-v"></i>
                            </button>
                        </th>
                        <th scope="col">{{ __('common.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach ($groups as $key => $group)
                        <tr>
                            <td class="name">
                                {{ $group->name }}
                                <span class="emphasis">({{ $group->machine_name }})</span>
                            </td>
                            <td class="teacher">{{ $teachers[$group->teacher]->name  }}</td>
                            <td class="start">{{ date('d/m/Y', strtotime($group->start_date)) }}</td>
                            <td class="end">{{ date('d/m/Y', strtotime($group->end_date)) }}</td>
                            <td>
                                <a href="{{ route('groups.show', ['id' => $group->id]) }}" title="{{ __('groups.show') }}"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('groups.edit', ['id' => $group->id]) }}" title="{{ __('groups.edit') }}"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{ route('groups.delete', ['id' => $group->id]) }}" title="{{ __('groups.delete') }}"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="container-pagination">
                <button class="btn-pagination" id="js-pagination-prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <ul class="pagination"></ul>
                <button class="btn-pagination" id="js-pagination-next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="container-empty-search" id="js-empty-search" aria-hidden="true">
            <p class="emphasis">{{ __('common.no-result') }}</p>
        </div>
    </div>
@endsection
