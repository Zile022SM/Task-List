@extends('Task_Layout.app')
    
@section('content')
    <div class="container mx-auto flex flex-col items-center mt-6">
    <h1 class="text-3xl font-bold underline pb-5">List of tasks</h1>
        @if(count($tasks) > 0)
            @foreach($tasks as $task)
                <div class="justify-start">
                    <a href="{{route('single-task', $task->id)}}">{{ $task->title }}</a>
                </div>
            @endforeach
        @else
            <div>There are no tasks</div>
        @endif
    </div>
@endsection