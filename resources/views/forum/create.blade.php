@extends('layouts.app')
@section('content')
    @php $locale = session()->get('locale') @endphp
    <div class="py-5 text-center">
        <h1 class="display-1">@lang('lang.create_post')</h1>
    </div>
    <div class="w-50 mx-auto">
        <form method="post">
            @csrf
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.post_title')</h6>
                    <input type="text" id="titre" name="titre" class="form-control w-50" />
                    @if ($errors->has('titre'))
                        <div class="text-danger mt-2">{{ $errors->first('titre') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.post_content')</h6>
                    <textarea class="form-control" id="corps" name="corps" class="form-control" rows="20"></textarea>
                    @if ($errors->has('corps'))
                        <div class="text-danger mt-2">{{ $errors->first('corps') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.language')</h6> 
                    <select name="langue" id="langue" class="form-select w-50">
                            <option value="en" @if($locale=='en') selected @endif>English</option>
                            <option value="fr "@if($locale=='fr') selected @endif>Français</option>
                    </select>
                </li>
            </ul>
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-success mx-2" value="@lang('lang.send')">
                <a href="{{ route('forum.index') }}" class="btn btn-danger mx-2">@lang('lang.cancel')</a>
            </div>
        </form>
    </div>
@endsection