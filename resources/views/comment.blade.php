@foreach($comments as $item)
    <div class="uk-card uk-card-default uk-card-small uk-width-auto uk-margin-bottom"
         style="margin-left: {{ $delimiter ?? 0 }}px;">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" data-uk-grid>


                <div class="uk-width-auto">
                    <img class="uk-border-circle" width="50" height="50" src="{{ asset('img/avatar.jpg') }}" alt="Avatar">
                </div>
                <div class="uk-width-auto" style="min-width: 400px;">
                    <h3 class="uk-card-title uk-margin-remove">
                        <b>{{ $item->user_name }}</b>
                    </h3>
                    <p class="uk-text-meta uk-margin-remove">
                        {{ $item->email }}
                    </p>
                    <p class="uk-text-meta uk-margin-remove">
                        {{-- $item->created_at --}}
                        {{ date('d.m.Y', strtotime($item->created_at)) }} в {{ date('H:i', strtotime($item->created_at)) }}
                    </p>
                    {{--<p class="uk-text-meta uk-margin-remove">
                        <span class="uk-margin-small-right" data-uk-icon="arrow-up"></span>
                        {{ date('d.m.Y H:i:s', strtotime($item->created_at)) }}
                        <span class="uk-margin-small-right" data-uk-icon="arrow-down"></span>
                    </p>--}}
                </div>

                <div class="uk-width-expand">
                    @if(request('sorting_by') === 'user_name' && request('order') === 'asc')
                        <a href="{{ route('index', ['sorting_by' => 'user_name', 'order' => 'desc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="user"
                           data-uk-tooltip="Сортировать по имени пользователя"></a>
                    @elseif(request('sorting_by') === 'user_name' && request('order') === 'desc')
                        <a href="{{ route('index', ['sorting_by' => 'user_name', 'order' => 'asc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="user"
                           data-uk-tooltip="Сортировать по имени пользователя"></a>
                    @else
                        <a href="{{ route('index', ['sorting_by' => 'user_name', 'order' => 'asc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="user"
                           data-uk-tooltip="Сортировать по имени пользователя"></a>
                    @endif

                    @if(request('sorting_by') === 'email' && request('order') === 'asc')
                        <a href="{{ route('index', ['sorting_by' => 'email', 'order' => 'desc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="mail"
                           data-uk-tooltip="Сортировать по E-mail"></a>
                    @elseif(request('sorting_by') === 'email' && request('order') === 'desc')
                        <a href="{{ route('index', ['sorting_by' => 'email', 'order' => 'asc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="mail"
                           data-uk-tooltip="Сортировать по E-mail"></a>
                    @else
                        <a href="{{ route('index', ['sorting_by' => 'email', 'order' => 'desc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="mail"
                           data-uk-tooltip="Сортировать по E-mail"></a>
                    @endif

                    @if(request('sorting_by') === 'created_at' && request('order') === 'asc')
                        <a href="{{ route('index', ['sorting_by' => 'created_at', 'order' => 'desc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="clock"
                           data-uk-tooltip="Сортировать по дате добавления комментария"></a>
                    @elseif(request('sorting_by') === 'created_at' && request('order') === 'desc')
                        <a href="{{ route('index', ['sorting_by' => 'created_at', 'order' => 'asc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="clock"
                           data-uk-tooltip="Сортировать по дате добавления комментария"></a>
                    @else
                        <a href="{{ route('index', ['sorting_by' => 'created_at', 'order' => 'asc']) }}"
                           class="uk-icon-button uk-margin-small-right {{ $item->parent_id !== null ? 'uk-disabled' : '' }}"
                           data-uk-icon="clock"
                           data-uk-tooltip="Сортировать по дате добавления комментария"></a>
                    @endif
                </div>

                <div class="uk-width-auto">
                    <a class="uk-icon-button" href="#modal-center" data-uk-toggle
                       onclick="answer({{ $item->id }})"
                       data-uk-icon="comment"
                       data-uk-tooltip="ОТВЕТИТЬ НА КОММЕНТАРИЙ"></a>
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
            'delimiter' => isset($delimiter) ? $delimiter + 50 : 50
        ])
    @endif
@endforeach
