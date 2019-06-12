@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="main-content--header">
            {{ Breadcrumbs::render('composite-tests.edit', $test) }}
            <h1>Modifier</h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('composite-tests.update', ['id' => $test->id]) }}">
            @csrf
            {{ method_field('PUT')}}

            <div class="field-container">
                <label for="name">Nom <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="{{ $test->name }}" required>
            </div>

            <div class="field-container">
                <label for="version">Version <span class="required">*</span></label>
                <input type="number" id="version" name="version" value="{{ $test->version }}" required>
            </div>

            <div class="field-container">
                <label for="visible">Visibility <span class="required">*</span></label>
                <input
                        type="number"
                        id="visible"
                        name="visible"
                        min="0"
                        max="1"
                        step="1"
                        aria-describedby="visible-description"
                        value="{{ $test->visible }}"
                        required
                >
                <p id="visible-description">1 for public, 0 for private.</p>
            </div>

            @php($p = "version")
            {{ $test->$p }}

            @for ($i = 1; $i < 8; $i++)
                <div class="field-container">
                    <label for="exercise_part{{ $i }}">Part {{ $i }}</label>
                    <select id="exercise_part{{ $i }}" name="exercise_part{{ $i }}">
                        <option></option>
                        @foreach ($exercises as $exercise)
                            @php($p = "exercise_part" . $i)
                            <option
                                    value="{{ $exercise->id }}"

                                    @if($test->$p == $exercise->id)
                                        selected
                                    @endif
                            >

                                {{ $exercise->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endfor

            <button type="submit" class="btn btn-primary">
                {{ __('Validate') }}
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    @for ($i = 1; $i < 8; $i++)
            const choices{{ $i }} = new Choices('#exercise_part{{ $i }}');
            @endfor
        });
    </script>
@endsection