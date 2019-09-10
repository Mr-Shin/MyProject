@extends('layouts.admin')

@section('content')
    <table class="table table-striped index">

        <tr>
            <th>
                Notification
            </th>
            <th>
            </th>
        </tr>
        @foreach($notif as $n)

            <tr>

                <td>
                    @if($n->type=="App\Notifications\NewCommentAdded")
                       {{$n->data['comment']['author']}} commented on your <a href="{{route('books.show',['id'=>$n->data['comment']['book_id']])}}">post.</a>
                    @endif
                </td>
                <td>

                </td>
                <td>
                    {!! $n->created_at->diffForHumans()!!}
                </td>

            </tr>
        @endforeach
    </table>
@endsection