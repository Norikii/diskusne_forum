@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex">
                                <a href="/profiles/{{ $thread->owner->name }}">{{ $thread->owner->name }}</a> posted:
                                {{ $thread->title }}
                            </span>
                            @can('update', $thread)
                            <form action="{{ $thread->path() }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-link">Delete Thread</button>
                            </form>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                <replies
                         @removed="repliesCount--"
                         @added="repliesCount++">
                </replies>

                {{--<div style="margin-top: 20px">--}}
                    {{--{{ $replies->links() }}--}}
                {{--</div>--}}


            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->owner->name }}</a>, and currently
                            has <span v-text="repliesCount"></span>
                            {{ str_plural('comment', $thread->replies_count) }}.
                        </p>

                        <p>
                            <subscribe-button :active="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </thread-view>


@endsection
<script>
    import SubscribeButton from "../../js/components/SubscribeButton";
    export default {
        components: {SubscribeButton}
    }
</script>
