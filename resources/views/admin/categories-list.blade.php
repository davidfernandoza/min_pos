@extends('layouts.admin')

@section('content')
	<category-list-admin :categories="{{$categories}}"/>
@endsection
