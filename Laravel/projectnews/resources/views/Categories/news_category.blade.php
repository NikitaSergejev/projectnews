@extends('layouts.appMain')
@section('content')
 <div class="container" style="display: flex;
                            flex-direction: row;
                            align-items: flex-start;
                            gap:3%;"
                        >
    <table id="example1">
        <thead>
            <th>News Portal</th>
        </thead>
     <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>
                <a href="{{ url('/categorynews/' . $category->id) }}">
                    {{ $category->name }}
                </a>
                <!--(count: {{ $category->tasks_count ?? 0 }})-->
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
    @if (count($tasks ?? '') > 0)
        <div class="row">
            @foreach($tasks as $task)
                <div class="col-md-4">
                    <div class="thumbnail">
                        @if($task->image!="")
                            <img src="{{ asset('images/' . $task->image) }}" alt="{{ $task->name }}" class="img-responsive">
                        @else
                            <p>No poster</p>
                    @endif
                        <div class="caption">
                            <h3>{{ $task->title }}</h3>
                            <p>{{ $task->category_id }} - {{ $task->category->name }}</p>
                            <p>{{ $task->updated_at->format('d.m.Y') }}</p>
                        </div>
                        <a href="{{url('show/'. $task->id)}}">Подробнее</a>
                        <p class="commentscount"><span class="spancomment">Comments count:</span>{{count($task->comments)}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Data not found</p>
    @endif 

</div>
<div class="container">
    <p>Всего новостей: {{ count($tasks) }}</p>
</div>

@endsection
