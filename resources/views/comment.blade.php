@foreach($comments as $item)
    <div class="uk-card uk-card-default uk-width-auto uk-margin-bottom"
         style="margin-left: {{ $delimiter }}px;">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                <div class="uk-width-auto">
                    <img class="uk-border-circle" width="40" height="40" src="{{ asset('img/avatar.jpg') }}" alt="Avatar">
                </div>
                <div class="uk-width-expand">
                    <h3 class="uk-card-title uk-margin-remove-bottom">{{ $item->user_name }}</h3>
                    <p class="uk-text-meta uk-margin-remove-top">
                        <time datetime="{{ $item->created_at }}">{{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}</time>
                    </p>
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
