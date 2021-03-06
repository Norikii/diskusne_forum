@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>
                {{ $profileUser->name }}
                {{--<small>Since {{ $profileUser->created_at->diffForHumans() }}</small>--}}
            </h1>
        </div>
        <hr>

        @forelse($activities as $date => $activity)
            <h3 style="margin-top: 20px" class="page-header">{{ $date }}</h3>
            @foreach($activity as $record)
                @if (view()->exists("profiles.activities.{$record->type}"))
                    @include("profiles.activities.{$record->type}", ['activity' => $record])
                @endif
            @endforeach
        @empty
            <p>There is no activity for this user yet.</p>
        @endforelse

        {{--{{ $threads->links() }}--}}
    </div>
@endsection
