@extends('layouts.app')

@section('content')
    <div class="main-content list-tests">
        <div class="main-content--header">
            <h1>
                Liste des tests composés
                <a href="{{ route('composite-tests.create') }}" class="main-content--header-actions">
                    <i class="fas fa-plus-circle"></i>
                </a>
            </h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @elseif ($message = Session::get('error'))
            <div class="alert alert-error">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="table" id="composite-tests">
            <h2>Tous les tests composés</h2>
            <div class="table--filters">
                <div class="field-container">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" class="search">
                </div>
            </div>
            <div class="table-container">
                <table>
                    <caption class="sr-only">Liste des tests composés</caption>
                    <thead>
                    <tr>
                        <th scope="col">
                            <button class="sort" data-sort="name">
                                Name <i class="fas fa-arrows-alt-v"></i>
                            </button>
                        </th>
                        <th scope="col">
                            <button class="sort" data-sort="version">
                                Version <i class="fas fa-arrows-alt-v"></i>
                            </button>
                        </th>
                        <th scope="col">
                            <button class="sort" data-sort="exercises">
                                Exercises <i class="fas fa-arrows-alt-v"></i>
                            </button>
                        </th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach ($tests as $key => $test)
                        <tr>
                            <td class="name">{{ $test['name'] }}</td>
                            <td class="version">{{ $test['version'] }}</td>
                            <td>
                                <ul>
                                    @if ($test['exercise_part1'])<li><a href="{{ action('ExerciseController@show', ['id' => $test['exercise_part1']['id']]) }}">{{ $test['exercise_part1']['name'] }}</li>@endif
                                    @if ($test['exercise_part2'])<li><a href="{{ action('ExerciseController@show', ['id' => $test['exercise_part2']['id']]) }}">{{ $test['exercise_part2']['name'] }}</li>@endif
                                    @if ($test['exercise_part3'])<li><a href="{{ action('ExerciseController@show', ['id' => $test['exercise_part3']['id']]) }}">{{ $test['exercise_part3']['name'] }}</li>@endif
                                    @if ($test['exercise_part4'])<li><a href="{{ action('ExerciseController@show', ['id' => $test['exercise_part4']['id']]) }}">{{ $test['exercise_part4']['name'] }}</li>@endif
                                    @if ($test['exercise_part5'])<li><a href="{{ action('ExerciseController@show', ['id' => $test['exercise_part5']['id']]) }}">{{ $test['exercise_part5']['name'] }}</li>@endif
                                    @if ($test['exercise_part6'])<li><a href="{{ action('ExerciseController@show', ['id' => $test['exercise_part6']['id']]) }}">{{ $test['exercise_part6']['name'] }}</li>@endif
                                    @if ($test['exercise_part7'])<li><a href="{{ action('ExerciseController@show', ['id' => $test['exercise_part7']['id']]) }}">{{ $test['exercise_part7']['name'] }}</li>@endif
                                </ul>

                            </td>
                            <td>
                                <a href="{{ action('CompositeTestController@show', ['id' => $test['id']]) }}">Try !</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
