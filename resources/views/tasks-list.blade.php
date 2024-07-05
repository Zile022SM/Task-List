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
        <h1 class="text-3xl text-orange-500 mb-6 flex flex-col items-center gap-6">List of tasks
          <span>
            <a href="{{ route('create-task') }}" class="text-blue-500 hover:underline text-sm flex items-center gap-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                </svg> Add new task
            </a>  
          </span>
        </h1>
        
        @if(count($tasks) > 0)
           
                <div class="justify-start">
                    <ol>
                    @foreach($tasks as $task)
                    <li class="bg-{{ $task->id === session()->get('updated_task') ? 'orange' : 'red' }}-500 flex items-center gap-2"><span class="text-orange-500">
                        {{ $task->id }} </span> - <a href="{{route('single-task', $task->id)}}" class="text-blue-500 hover:underline">{{ $task->title }}</a> 
                        <a href="{{ route('edit-task', $task->id) }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"      stroke="currentColor" class="size-6 text-yellow-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </span>
                        </a>
                     
                        <form action="{{route('task.delete', $task->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                            <span class="text-red-600 hover:underline cursor-pointer" wire:click="deleteTask({{ $task->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </span>
                            </button>
                        </form>      
                    </li>
                    @endforeach
                    </ol>
                   
                </div>
            
        @else
            <div>There are no tasks</div>
        @endif
    </div>
@endsection