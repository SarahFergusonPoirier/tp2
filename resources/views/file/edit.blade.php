@extends('layouts.app')
@section('content')
    <div class="py-5 text-center">
        <h1 class="display-3 w-50 m-auto">{{ $file->name }}</h1>
    </div>
    <div class="w-50 mx-auto">
        <form method="post">
            @method('put')
            @csrf
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.file_name')</h6>
                    <input type="text" id="name" name="name" class="form-control w-50" value="{{ $file->name }}" />
                    @if ($errors->has('name'))
                        <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.language')</h6> 
                    <select name="langue" id="langue" class="form-select w-50">
                            <option value="en" @if($file->langue == "en") selected @endif>English</option>
                            <option value="fr" @if($file->langue == "fr") selected @endif>Français</option>
                    </select>
                </li>
            </ul>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-success mx-2" value="@lang('lang.send')">
                <a href="{{ route('file.show', $file->id) }}" class="btn btn-danger mx-2">@lang('lang.cancel')</a>
            </div>
        </form>
    </div>
@endsection