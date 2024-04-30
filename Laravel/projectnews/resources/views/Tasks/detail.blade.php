@extends('layouts.appMain')
@section('content')
    <div class="box-body" style="margin-left:2em; ">
        @if ($task)
            <div style="display:flex;
                        flex-direction: column;
                        width:85em">
                    <h3>{{ $task->title }}</h3>
                    <div style="display:flex; gap:1em;">
                        <img src="{{ asset('images/' . $task->image) }}" alt="{{ $task->name }}" class="img-responsive" style="width: 357px">
                        <p>{{ $task->description }}</p>
                    </div>
                    <div class="caption">
                    <p>Категория - {{ $task->category->name }}</p>
                    <p>{{ $task->updated_at->format('d.m.Y') }}</p>
                </div>
                <a href="{{url('/news')}}">Back to list</a>
            </div>
        @else
            <p>Data not found</p>
        @endif
    </div>
    <!--Comments -->
    <hr />
    @if(Auth::check())
    <div class="container">
        <div class="col-sm-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Comments Add</h4></div>
                <div class="panel-body">
                    <form action="{{url('/comments')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Comment text <i>(1000 symbols)</i>:</strong>
                                    <textarea class="form-control" style="height:50px" name="body" required></textarea>
                                </div>
                            </div>
                            <!--Это Ид новости для комментов -->
                            <input type="hidden" name="taskid" value="{{$task->id}}" class="form-control" placeholder="newsId" readonly>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Send comment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    <hr>
    <h4>Comments List</h4>
    @forelse ($task->comments as $comment)
        <p><i>Author:</i>{{$comment->user->name}}<br>
            <i>Date created:</i>{{date('d-m-Y', strtotime($comment->created_at))}}</p>
        <p><span class="spanclass">Comment:</span>{{$comment->body}}</p>
        <hr>
    @empty
        <p>This post has no comments</p>
    @endforelse
@endsection
