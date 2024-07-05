@extends('Task_Layout.app')
    
@section('title', isset($task) ? 'Edit Task' : 'Create Task')

@section('content')
    <form action="{{isset($task) ? route('task.update', $task) : route('tasks.store') }}" method="POST" class="lg:w-[50%] md:w-[50%] sm:w-[100%] mt-12 flex flex-col justify-start items-center bg-slate-300 mx-auto p-7 ">
        @csrf

        @isset($task)
            @method('PUT')
        @endisset

        <div class="flex w-[100%] gap-6 mb-10 items-center">

            <div class="flex flex-col w-[50%]">
                <label for="title" class="text-orange-500 mb-2">Title</label>
                <input type="text" name="title" value="{{$task->title ?? old('title')}}" placeholder="enter task title" class="px-2">
                @error('title')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col w-[50%]">
                <label for="title" class="text-orange-500 mb-2">Completed</label>
                <input type="number" name="completed" value="{{$task->completed ?? old('completed')}}" placeholder="enter completed status" class="px-2">
                @error('completed')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="flex w-[100%] gap-6 items-center">

            <div class="flex flex-col w-[50%]">
                <label for="title" class="text-orange-500 mb-2">Text</label>
                <textarea name="description" id="">{{$task->description ?? old('description')}}</textarea>
                @error('description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col w-[50%]">
                <label for="title" class="text-orange-500 mb-2">Long text</label>
                <textarea name="long_description" id="">{{$task->long_description ?? old('long_description')}}</textarea>
                @error('long_description')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

        </div>
        
        <div class="flex justify-end w-[100%] items-center">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-6">
                @isset($task) Update @else Create @endisset task
            </button>
        </div>
        
    </form>
@endsection