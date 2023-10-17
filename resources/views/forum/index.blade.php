@extends('layouts.app')
@section('content')
    <div class="w-50 mx-auto">
        <a href="{{ route('forum.create') }}" class='btn btn-primary w-100 mb-3'>@lang('lang.create_post')</a>
        <ul class="list-group list-group-flush">
            @forelse($posts as $post)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('forum.show', $post->id) }}" class="link-offset-2 link-underline link-underline-opacity-0">{{ $post->titre }}</a>
                    <span>@lang('lang.by') @foreach($users as $user) @if($user->id == $post->user_id) {{ $user->name }} @endif @endforeach</span>
                </li>
            @empty
                <li>@lang('lang.no_article')</li>
            @endforelse
        </ul>
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
@endsection