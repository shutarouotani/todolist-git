@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <?php view('auth\login'); ?>
    @else
        <?php view('tasks.index'); ?>
    @endif
@endsection