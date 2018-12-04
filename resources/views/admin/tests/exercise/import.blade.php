@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="main-content--header">
            <h1>Importer un fichier de questions</h1>
        </div>

        <form method="POST" action="{{ route('tests.exercise.importStore') }}" enctype="multipart/form-data">
            @csrf

            <div class="field-container">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="field-container">
                <label for="version">Version <span class="required">*</span></label>
                <input type="number" id="version" name="version" min="1960" max="2200" required>
            </div>

            <div class="field-container">
                <label for="questions">Questions</label>
                <input type="file" id="questions" name="questions">
            </div>

            <div class="field-container">
                <label for="answers">Answers <span class="required">*</span></label>
                <input type="file" id="answers" name="answers" required>
            </div>

            <div class="field-container">
                <label for="documents">Documents</label>
                <input type="file" id="documents" name="documents">
            </div>

            <div class="field-container">
                <label for="audios">Audios</label>
                <input type="file" id="audios" name="audios">
            </div>

            <div class="field-container">
                <label for="part">Part <span class="required">*</span></label>
                <select name="part" id="part" required>
                    @foreach($parts as $part)
                        <option value="{{ $part->id }}">{{ $part->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ __('Submit') }}
            </button>
        </form>
    </div>
@endsection