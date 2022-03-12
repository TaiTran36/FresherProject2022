@if (Auth::user()->role == 1) 
    @extends('layouts.admin')
@endif