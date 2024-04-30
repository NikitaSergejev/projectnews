@extends('layouts.appMain')
@section('content')
<div class="box-header">
<h2>Welcome News Portal Laravel Main Page</h2>
</div>
<div class="box-body">
    @if (count($tasks ?? '') > 0)
        <div class="row">
            @foreach($tasks as $task)
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="{{ asset('images/' . $task->image) }}" alt="{{ $task->name }}" class="img-responsive">
                        <div class="caption">
                            <h3>{{ $task->title }}</h3>
                            <p>{{ $task->category_id }} - {{ $task->category->name }}</p>
                            <p>{{ $task->updated_at->format('d.m.Y') }}</p>
                        </div>
                        <a href="{{url('show/'. $task->id)}}">Подробнее</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Data not found</p>
    @endif
</div>
@endsection
