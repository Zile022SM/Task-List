@extends('Task_Layout.app')

@section('content')
    <div class="container mx-auto mt-5 flex flex-col items-start p-5">
        <h1 class="text-3xl text-orange-500 font-bold pb-5 mt-5 italic">{{ $task->title }}</h1>
        <p>{{ $task->description }}</p>
        <p>{{ $task->long_description }}</p>
        <div class="mx-auto mt-6">
            <p class="text-orange-500 mt-5 justify-center">{{ $task->created_at }}</p>
            <p class="text-orange-500">{{ $task->updated_at }}</p>
        </div>
    </div>
@endsection
