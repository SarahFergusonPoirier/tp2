@extends('layouts.app')
@section('content')
    <div class="py-5 text-center">
        <h1 class="display-1">{{ $etudiant->nomEtudiant }}</h1>
    </div>
    <div class="w-50 mx-auto">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6>@lang('lang.name')</h6>
                <span>{{ $etudiant->nomEtudiant }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6>@lang('lang.birthday')</h6>
                <span>{{ \Carbon\Carbon::parse($etudiant->naissance)->format('F j, Y') }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6>@lang('lang.phone')</h6>
                <span>{{ $etudiant->phone }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6>@lang('lang.email')</h6>
                <span>{{ $etudiant->email }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6>@lang('lang.address')</h6>
                <span>{{ $etudiant->adresse }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6>@lang('lang.city')</h6>
                <span>{{ $ville }}</span>
            </li>
        </ul>
        <div class="d-flex justify-content-center">
            <a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-primary mx-2">@lang('lang.modify')</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">@lang('lang.delete')</button> 
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
                    @lang('lang.confirm_delete') {{ $etudiant->nomEtudiant }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.close')</button>
                    <form action="{{route('etudiant.delete', $etudiant->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="@lang('lang.delete')" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection