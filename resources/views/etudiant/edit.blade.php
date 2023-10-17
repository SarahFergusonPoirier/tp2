@extends('layouts.app')
@section('content')
    <div class="py-5 text-center">
        <h1 class="display-1">{{ $etudiant->nomEtudiant }}</h1>
    </div>
    <div class="w-50 mx-auto">
        <form method="post">
            @method('put')
            @csrf
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.name')</h6>
                    <input type="text" id="nomEtudiant" name="nomEtudiant" class="form-control w-50" value="{{ $etudiant->nomEtudiant }}" />
                    @if ($errors->has('name'))
                        <div class="text-danger mt-2">{{ $errors->first('name') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.birthday')</h6>
                    <input type="date" id="naissance" name="naissance" class="form-control w-50" value="{{ $etudiant->naissance }}" />
                    @if ($errors->has('birthday'))
                        <div class="text-danger mt-2">{{ $errors->first('birthday') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.phone')</h6>
                    <input type="text" id="phone" name="phone" class="form-control w-50" value="{{ $etudiant->phone }}" />
                    @if ($errors->has('phone'))
                        <div class="text-danger mt-2">{{ $errors->first('phone') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.email')</h6>
                    <input type="text" id="email" name="email" class="form-control w-50" value="{{ $etudiant->email }}" />
                    @if ($errors->has('email'))
                        <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.address')</h6>
                    <input type="text" id="adresse" name="adresse" class="form-control w-50" value="{{ $etudiant->adresse }}" />
                    @if ($errors->has('address'))
                        <div class="text-danger mt-2">{{ $errors->first('address') }}</div>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6>@lang('lang.city')</h6> 
                    <select name="ville_id" id="ville_id" class="form-select w-50">
                        @forelse($villes as $ville)
                            <option value="{{ $ville->id }}" @if($ville->id == $etudiant->ville_id) selected @endif>{{ $ville->nomVille }}</option>
                        @empty
                            <option value="null">@lang('lang.unavailable')</option>>
                        @endforelse
                    </select>
                </li>
            </ul>
            <input type="hidden" id="user_id" name="user_id" value="{{ $etudiant->user_id }}">
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-success mx-2" value="@lang('lang.send')">
                <a href="{{ route('etudiant.show', $etudiant->id) }}" class="btn btn-danger mx-2">@lang('lang.cancel')</a>
            </div>
        </form>
    </div>
@endsection