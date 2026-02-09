@extends('layouts.app')

@section('content')
    <livewire:movie-list :locale="app()->getLocale()" />
@endsection
