@extends('layouts.admin')

@section('content')
	<admin-body :data="{{$users}}" view_type="users"/>
@endsection
