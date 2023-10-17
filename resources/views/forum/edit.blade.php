@extends('layouts.app')
@section('content')
    <div class="py-5 text-center">
        <h1 class="display-3 w-50 m-auto">{{ $post->titre }}</h1>
    </div>
    <div class="w-50 mx-auto">
        <form method="post">
            @method('put')
            @csrf
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.post_title')</h6>
                    <input type="text" id="titre" name="titre" class="form-control w-50" value="{{ $post->titre }}" />
                    @if ($errors->has('titre'))
                        <div class="text-danger mt-2">{{ $errors->first('titre') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.post_content')</h6>
                    <textarea class="form-control" id="corps" name="corps" class="form-control" rows="20">{{$post->corps}}</textarea>
                    @if ($errors->has('nomEtudiant'))
                        <div class="text-danger mt-2">{{ $errors->first('corps') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.language')</h6> 
                    <select name="langue" id="langue" class="form-select w-50">
                            <option value="en" @if($post->langue == "en") selected @endif>English</option>
                            <option value="fr" @if($post->langue == "fr") selected @endif>Français</option>
                    </select>
                </li>
            </ul>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-success mx-2" value="@lang('lang.send')">
                <a href="{{ route('forum.show', $post->id) }}" class="btn btn-danger mx-2">@lang('lang.cancel')</a>
            </div>
        </form>
    </div>
@endsection