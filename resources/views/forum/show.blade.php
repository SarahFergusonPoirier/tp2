@extends('layouts.app')
@section('content')
    <div class="w-50 mx-auto">
        <h1 class="display-1 text-center">{{ $post->titre }}</h1>
        <h2 class="display-6 text-center">@lang('lang.created_at') {{ $post->created_at }} | @lang('lang.by') {{ $nomUser }}</h2>
        <p>{{ $post->corps }}</p>
        <div class="d-flex justify-content-center">
            @if(Auth::id() == $post->user_id || Auth::user()->can('create-users'))
                <a href="{{ route('forum.edit', $post->id) }}" class="btn btn-primary mx-2">@lang('lang.modify')</a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">@lang('lang.delete')</button> 
            @endif
        </div>     
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('lang.erase')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @lang('lang.confirm_delete') {{ $post->titre }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <form action="{{route('forum.delete', $post->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="@lang('lang.delete')" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection