@extends('Task_Layout.app')

@section('content')
    <div class="container mx-auto mt-5 flex flex-col items-center bg-slate-500 w-[500px] h-[250px]">
        <h1 class="text-3xl text-slate-200 pb-5 mt-5 italic">{{ $task->title }}</h1>
        <p>{{ $task->description }}</p>
        <p>{{ $task->long_description }}</p>
        <p>{{ $task->completed }}</p>
        <p class="text-slate-200 mt-5">{{ $task->created_at }}</p>
        <p class="text-slate-200">{{ $task->updated_at }}</p>

    </div>
@endsection
