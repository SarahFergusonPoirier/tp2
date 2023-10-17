@extends('layouts.app')
@section('content')
    <div class="w-50 mx-auto">
        <a href="{{ route('etudiant.create') }}" class='btn btn-primary w-100 mb-3'>@lang('lang.add_student')</a>
        <ul class="list-group list-group-flush">
            @forelse($etudiants as $etudiant)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('etudiant.show', $etudiant->id) }}" class="link-offset-2 link-underline link-underline-opacity-0">{{ $etudiant->nomEtudiant }}</a>
                    <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-primary mx-2">@lang('lang.modify')</a>
                </li>
            @empty
                <li>@lang('lang.no_student')</li>
            @endforelse
        </ul>
        {{ $etudiants->links('pagination::bootstrap-4') }}
    </div>
@endsection