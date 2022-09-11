@extends('dashboard')

@section('content')

<div class="flex flex-col py-3">
    <h2 class="text-2xl font-bold">Dashboard</h2>
</div>

<div class="overflow-x-auto mb-3 text-lg leading-relaxed">
    <p>Welcome back, {{ Auth::user()->name }}!</p>
</div>

@endsection