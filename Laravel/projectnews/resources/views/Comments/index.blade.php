@extends('layouts.app')
@section('content')
<div class="box-body">
	@if (count($comments ?? '') > 0)
	<table class="table table-bordered">
		<thead>
		  <th width=3%>N/#</th>
		  <th width="20%">Description</th>
          <th>Name user</th>
          <th>News</th>
		  <th>Date created</th>
		  <th>Tools</th>
		</thead>
		<tbody>
		@foreach($comments as $comment)
			<tr>
				<td>{{ $comment->id }}</td>
                <td>{{$comment->body}}</td>
                @if($comment->user)
                    <td>{{ $comment->user->name }}</td>
                @else
                    <td>N/A</td>
                    <td>N/A</td>
                @endif
                @if($comment->task)
                    <td>{{$comment->task->title}}</td>
                @elseа
                    <td>No associated task</td>
                @endif
				<td>{{ $comment->created_at->format('d.m.Y') }}</td>
				<td>
                    <form id="deleteCommentForm-{{ $comment->id }}" action="{{ url('deletecomment/' . $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm delete btn-flat" onclick="confirmDelete({{ $comment->id }})">
                            <i class='fa fa-trash'></i> Delete
                        </button>
                    </form>
                    @if ($comment->task)
                        <a href="{{ url('show/' . $comment->task->id) }}">Show news</a>
                    @endif
                </td>
                <script>
                    function confirmDelete(commentId) {
                        var result = confirm("Are you sure you want to delete this comment?");
                        if (result) {
                            document.getElementById('deleteCommentForm-' + commentId).submit();
                        }
                    }
                </script>
			</tr>
		@endforeach
		</tbody>
	</table>
	@else
		<p>Data no found</p>
	@endif
</div>
@endsection
