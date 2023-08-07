@foreach($comments as $item)
    <div class="uk-card uk-card-default uk-card-small uk-width-auto uk-margin-bottom"
         style="margin-left: {{ $delimiter }}px;">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                <div class="uk-width-auto">
                    <img class="uk-border-circle" width="40" height="40" src="{{ asset('img/avatar.jpg') }}" alt="Avatar">
                </div>
                {{--<div class="uk-width-expand">
                    <h3 class="uk-card-title uk-margin-remove-bottom">{{ $item->user_name }}</h3>
                    <p class="uk-text-meta uk-margin-remove-top">
                        <time datetime="{{ $item->created_at }}">{{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}</time>
                    </p>
                </div>--}}
                <div class="uk-width-auto">
                    <h3 class="uk-card-title uk-margin-remove-bottom">
                        <b>{{ $item->user_name }}</b>
                    </h3>
                    <p class="uk-text-meta uk-margin-remove-top">
                        {{ $item->email }}
                    </p>
                    {{--<p class="uk-text-meta uk-margin-remove">
                        <span class="uk-margin-small-right" data-uk-icon="arrow-up"></span>
                        {{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}
                        <span class="uk-margin-small-right" data-uk-icon="arrow-down"></span>
                    </p>--}}
                </div>

                <div class="uk-width-expand">
                    @if($item->parent_id === null)
                        @if(request('sorting_by') === 'date' && request('order') === 'asc')
                            <a href="{{ route('index', ['sorting_by' => 'date', 'order' => 'desc']) }}">
                                {{ date('d.m.Y', strtotime($item->created_at)) }} в {{ date('H:i', strtotime($item->created_at)) }}
                                <span class="uk-margin-small-right" data-uk-icon="arrow-up"></span>
                            </a>
                        @elseif (request('sorting_by') === 'date' && request('order') === 'desc')
                            <a href="{{ route('index', ['sorting_by' => 'date', 'order' => 'asc']) }}">
                                {{ date('d.m.Y', strtotime($item->created_at)) }} в {{ date('H:i', strtotime($item->created_at)) }}
                                <span class="uk-margin-small-right" data-uk-icon="arrow-down"></span>
                            </a>
                        @else
                            <a href="{{ route('index', ['sorting_by' => 'date', 'order' => 'asc']) }}">
                                {{ date('d.m.Y', strtotime($item->created_at)) }} в {{ date('H:i', strtotime($item->created_at)) }}
                            </a>
                        @endif
                    @else
                        <span>{{ date('d.m.Y', strtotime($item->created_at)) }} в {{ date('H:i', strtotime($item->created_at)) }}</span>
                    @endif
                </div>

                <div class="uk-width-auto">
                    <a class="uk-button uk-button-text" href="#modal-center" data-uk-toggle
                       onclick="answer({{ $item->id }})">Ответить</a>
                </div>
            </div>
        </div>
        <div class="uk-card-body">
            @php
                $originalComment = $item->comment;
                $formattedComment = preg_replace(
                    array("/\[code\]/", "/\[\/code\]/", "/\[i\]/", "/\[\/i\]/", "/\[strong\]/", "/\[\/strong\]/", "/\[a=(.*?)\]/", "/\[\/a\]/"),
                    array("<pre>", "</pre>", "<em>", "</em>", "<strong>", "</strong>", '<a href="$1">', "</a>"),
                    $originalComment
                );
            @endphp
            <p>{!! $formattedComment !!}</p>

            @if($item->file_name !== null && $item->original_file_name !== null)
                @if(pathinfo($item->original_file_name, PATHINFO_EXTENSION) === 'txt')
                    Загруженный файл: <a class="" target="_blank" href="{{ asset('/storage/'.$item->file_name) }}">{{ $item->original_file_name }}</a>
                @endif

                @if(pathinfo($item->original_file_name, PATHINFO_EXTENSION) === 'jpg' ||
                    pathinfo($item->original_file_name, PATHINFO_EXTENSION) === 'jpeg' ||
                    pathinfo($item->original_file_name, PATHINFO_EXTENSION) === 'png' ||
                    pathinfo($item->original_file_name, PATHINFO_EXTENSION) === 'gif' )
                    <div data-uk-lightbox>
                        Загруженный файл: <a class="" href="{{ asset('/storage/'.$item->file_name) }}">{{ $item->original_file_name }}</a>
                    </div>
                @endif
            @endif

        </div>
    </div>

    @if(count($item->answers) !== 0)
        {{--{{ $delimiter }}--}}
        @include('comment', [
            'comments' => $item->answers,
            'delimiter' => $delimiter + 50
        ])
    @endif
@endforeach
