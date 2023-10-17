@extends('layouts.app')
@section('content')
    <div class="w-50 mx-auto">
        <a href="{{ route('file.create') }}" class='btn btn-primary w-100 mb-3'>@lang('lang.add_file')</a>
        <ul class="list-group list-group-flush">
            @forelse($files as $file)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('file.show', $file->id) }}" class="link-offset-2 link-underline link-underline-opacity-0">{{ $file->name }}</a> 
                    <span> @lang('lang.by') @foreach($users as $user) @if($user->id == $file->user_id) {{ $user->name }} @endif @endforeach</span>
                </li>
            @empty
                <li>@lang('lang.no_file')</li>
            @endforelse
        </ul>
        {{ $files->links('pagination::bootstrap-4') }}
    </div>
@endsection