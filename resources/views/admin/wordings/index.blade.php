@extends('layouts.app')

@section('content')
    @inject('render', 'App\Services\RenderService')
    <div class="container">
        <div class="main-content">
            <h2>{{ __('wordings.explanation') }}</h2>

            <form method="POST" action="{{ route('wordings.store') }}" class="form-wordings">
                    @csrf
                    @foreach ($wordings as $key => $wording)
                        <div class="field-container">
                            <fieldset>
                                <legend>{{ $wording->group }}.{{ $wording->key }}</legend>
                                <div class="fields">
                                    @foreach ($wording->text as $lang => $value)
                                        <div class="field">
                                            <label class="form-label-text" for="{{ $wording->group }}.{{ $wording->key }}.{{ $lang }}">
                                                {{ $lang }} <span class="required">*</span>
                                            </label>
                                            <input
                                                    type="text"
                                                    name="{{ $wording->group }}.{{ $wording->key }}.{{ $lang }}"
                                                    value="{{ $value }}"
                                                    id="{{ $wording->group }}.{{ $wording->key }}.{{ $lang }}"
                                                    required
                                            >
                                            <p>{{ $value }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>

                        </div>
                    @endforeach
                    <div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('common.save') }}
                        </button>
                    </div>
                </form>
        </div>

    </div>
@endsection
