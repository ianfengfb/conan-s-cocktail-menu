@extends('layouts.customer-layout')

@section('content')
    <form action="/test" method="POST">
    @csrf
    <input type="text" name="name">
    <input type="submit" value="Submit">
    </form>
@endsection