@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <app-component :userrol="{{ auth()->user()->id_rol }}"></app-component>
</div>
@endsection
