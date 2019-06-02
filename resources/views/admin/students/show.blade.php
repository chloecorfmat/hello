@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="main-content--header">
            {{ Breadcrumbs::render('students.show', $student) }}
            <h1>Détails : {{ $student->name }}</h1>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="part-container student-profile">
            <p><strong class="important">Name: </strong>{{ $student->name }}</p>
            <p><strong class="important">Matricule: </strong>{{ $student->matricule }}</p>
            <p>
                <strong class="important">Passed: </strong>
                @if (!is_null($student->passed))
                    {{ date('d/m/Y', strtotime($student->passed)) }}
                @else
                    (Not validate)
                @endif
            </p>
        </div>

        <div class="part-container">
            <h2>Derniers exercices</h2>
            <div class="table" id="profile-tests">
                <div class="table--filters">
                    <div class="field-container">
                        <label for="search">Search</label>
                        <input type="text" id="search" name="search" class="search">
                    </div>
                </div>

                <div class="table-container is-visible">
                    <table>
                        <caption class="sr-only">Liste des tests passés</caption>
                        <thead>
                        <tr>
                            <th scope="col">
                                <button class="sort" data-sort="date">
                                    Date <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                            <th scope="col">
                                <button class="sort" data-sort="test">
                                    Nom du test <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                            <th scope="col">
                                <button class="sort" data-sort="score">
                                    Score <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach ($trials as $key => $trial)
                            <tr>
                                <td class="date">{{ date('d/m/Y H:i', strtotime($trial->datetime)) }}</td>
                                <td class="test">{{ $trial->test->name }}</td>
                                <td class="score">{{ $trial->score }}</td>
                                <td>
                                    <ul>
                                        <li>
                                            <a href="{{ route('student.trials.show', ['id' => $trial->id]) }}">Correction</a>
                                        </li>
                                        @role('student')
                                        <li>
                                            <a href="{{ action('TestController@show', ['id' => $trial->test->id]) }}">Execute</a>
                                        </li>
                                        @endrole
                                    </ul>
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
                <p class="emphasis">Aucun résultat.</p>
            </div>
        </div>

        <div class="part-container">
            <h2>Derniers tests composés</h2>
            <div class="table">
                <div class="table--filters">
                    <div class="field-container">
                        <label for="search">Search</label>
                        <input type="text" id="search" name="search" class="search">
                    </div>
                </div>

                <div class="table-container is-visible">
                    <table>
                        <caption class="sr-only">Liste des exercices passés</caption>
                        <thead>
                        <tr>
                            <th scope="col">
                                <button class="sort" data-sort="date">
                                    Date <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                            <th scope="col">
                                <button class="sort" data-sort="test">
                                    Nom du test <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                            <th scope="col">
                                <button class="sort" data-sort="score">
                                    Score <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                            @role('student')
                            <th scope="col">Actions</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach ($composite_trials as $key => $trial)
                            <tr>
                                <td class="date">{{ date('d/m/Y H:i', strtotime($trial->datetime)) }}</td>
                                <td class="test">{{ $composite_trials_names[$key] }}</td>
                                <td class="score">{{ $trial->score }}</td>
                                @role('student')
                                <td>
                                    <ul>

                                        <li>
                                            <a href="{{ action('CompositeTestController@show', ['id' => $trial->composite_test_id]) }}">Execute</a>
                                        </li>

                                    </ul>
                                </td>
                                @endrole
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
                <p class="emphasis">Aucun résultat.</p>
            </div>
        </div>

        <div class="part-container">
            <h2>Derniers challenges</h2>
            <div class="table" id="games">
                <div class="table--filters">
                    <div class="field-container">
                        <label for="search">Search</label>
                        <input type="text" id="search" name="search" class="search">
                    </div>
                </div>
                <div class="table-container is-visible">
                    <table>
                        <caption class="sr-only">Challenges list</caption>
                        <thead>
                        <tr>
                            <th>
                                <button class="sort" data-sort="date">
                                    Date <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                            <th>
                                <button class="sort" data-sort="score">
                                    Score <i class="fas fa-arrows-alt-v"></i>
                                </button>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach ($games as $key => $game)
                            <tr>
                                <td class="date">{{ date('d/m/Y H:i', strtotime($game->datetime)) }}</td>
                                <td class="score">{{ $game->score }}</td>
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
                <p class="emphasis">Aucun résultat.</p>
            </div>
        </div>
    </div>
@endsection
