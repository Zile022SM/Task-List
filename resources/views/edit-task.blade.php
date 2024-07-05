@extends('Task_Layout.app')
    
@section('title', 'Edit Task - '.$task->title)

@section('content')
  @include('form', ['task'=>$task])
@endsection