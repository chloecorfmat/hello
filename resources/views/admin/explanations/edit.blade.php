@extends('layouts.app')

@section('content')
    <div class="main-content">
        <form method="POST" action="{{ route('explanations.update', ['id' => $explanation->id]) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT')}}

            <div class="field-container">
                <label for="title">{{ __('common.title') }} <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="{{ $explanation->title }}" required>
            </div>

            <div class="field-container">
                <label for="explanation">{{ __('common.explanation') }} <span class="required">*</span></label>
                <textarea id="explanation" name="explanation" required>{{ $explanation->explanation }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('common.validate') }}
            </button>
        </form>
    </div>
@endsection
