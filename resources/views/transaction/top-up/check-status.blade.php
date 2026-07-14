@extends('layouts.app')

@section('main')
    @livewire('transaction.top-up.check-status', [
        'vaNumber' => $vaNumber,
    ])
@endsection
