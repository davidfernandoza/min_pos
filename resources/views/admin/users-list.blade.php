@extends('layouts.admin')

@section('content')
	<user-list-admin :users="{{$users}}"/>
@endsection
