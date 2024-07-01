@extends('Task_Layout.app')
    
@section('content')

    @if(session()->has('message'))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
            <div class="flex">
                {{ session()->get('message') }}
            </div>    
        </div>  
    @endif

    <div class="container mx-auto flex flex-col items-center mt-6">
        <h1 class="text-3xl text-orange-500 mb-6">List of tasks</h1>
        
        @if(count($tasks) > 0)
           
                <div class="justify-start">
                    <ol>
                    @foreach($tasks as $task)
                        <li><span class="text-orange-500">{{ $task->id }} </span> - <a href="{{route('single-task', $task->id)}}" class="text-blue-500 hover:underline">{{ $task->title }}</a></li>
                    @endforeach
                    </ol>
                   
                </div>
            
        @else
            <div>There are no tasks</div>
        @endif
    </div>
@endsection