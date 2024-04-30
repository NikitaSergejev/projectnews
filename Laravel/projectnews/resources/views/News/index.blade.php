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
        <!--    форма список по датам и названию для фильтрации данных
        <div class="pull-right">
            <form class="form-inline" action="{{ url('/newsBySort') }}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Sorting: </label>
                    <select class="form-control input-sm" name="sort_by" onChange="submit();">
                       
                    </select>
                </div>
            </form>
        </div>-->
        @foreach ($categories as $category)
            <tr>
                <td><a href="{{ url('/categorynews/' . $category->id) }}">{{ $category->name }}</a>
                    <!--(count: {{ optional($category->tasks)->count() ?? 0 }})-->
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
                        <img src="{{ asset('images/' . $task->image) }}" alt="{{ $task->name }}" class="img-responsive">
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
