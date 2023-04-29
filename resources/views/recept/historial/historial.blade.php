@extends('recept.layout.index')

@section('title', 'Historial')


@section('contenido')

<br>


@livewire('historial-dats')


@endsection
<link rel="stylesheet" href="css/tablas.css">
<style>
    svg {
        max-width: 20px;
        height: 20px;
    }
</style>