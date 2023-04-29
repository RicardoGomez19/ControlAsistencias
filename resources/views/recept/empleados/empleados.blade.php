@extends('recept.layout.index')

@section('title', 'Empleados')

@section('contenido')

<br>


@livewire('buscar-empleados')


@endsection

<link rel="stylesheet" href="{{asset('css/tablas.css')}}">
<style>
    svg {
        max-width: 20px;
        height: 20px;
    }
</style>