@extends('layouts.app')

@section('content')
    @php ($index = ['A', 'B', 'C', 'D'])

    <div class="main-content">
        <h1>Correction</h1>

        <div class="part-container">
            <div class="student-profile">
                <p><span>{{ $datas['trial']->user->firstname }} {{ $datas['trial']->user->lastname }}</span>, le <span>{{ date('d/m/Y à H:i', strtotime($datas['trial']->datetime)) }}</span></p>
                <p>Score : <span>{{ $datas['trial']->score }}</span>/{{ $datas['max_score'] }}</p>
                <h2>Statistiques générales</h2>
            </div>
        </div>

        <div class="part-container">
            @if (!Auth::user()->hasRole('teacher'))
                <p class="emphasis">La correction des questions liées aux parties de compréhension orale n'est pas affichée.</p>
            @endif
            <ol>
                @foreach ($datas['trial']->corrections as $key => $correction)
                    <!-- Question from reading (not listening) -->
                    @if ((Auth::user()->hasRole('teacher') || ($correction->question->number > 100)))
                        <li class="block-question"> {{-- State in class --}}
                                <p class="question-legend">({{ $correction->question->number }}) {{ $correction->question->question }}</p>
                                <ul>
                                    @foreach ($correction->question->proposals as $k => $proposal)
                                        @php ($class = '')
                                        @if ($proposal->id === $correction->question->answer->id)
                                            @php($class .= 'answer-real ')
                                        @endif

                                        @if (isset($correction->proposal) and $proposal->id === $correction->proposal->id)
                                            @php($class .= 'answer-user')
                                        @endif

                                        <li
                                                @isset($class)
                                                class="{{$class}}"
                                                @endisset
                                        >
                                            {{ $index[$k] }}. {{ $proposal->value }}
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                    @endif
                @endforeach
            </ol>
        </div>

        <a href="{{ route('profile') }}" class="btn">Retour</a>
    </div>
@endsection
