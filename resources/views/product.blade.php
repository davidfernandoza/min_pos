@extends('layouts.app')

@section('content')
	<product :products="{{$products}}"/>
@endsection
