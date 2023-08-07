@extends('layout.main')

@section('title', 'My home page')
@section('description', 'My page description')
@section('keywords', 'myKeyword1, myKeyword2, myKeyword3')

@section('content')
    <div class="uk-section uk-section-small uk-section-muted" style="min-height: 100vh;">
        <div class="uk-container uk-container-xlarge uk-margin-bottom">

            @php
                //var_dump($_POST);
                //dd($comments);
            @endphp

            <a class="uk-button uk-button-secondary uk-margin-bottom" href="#modal-center" data-uk-toggle>Добавить коментарий</a>

            {{-- modal form --}}
            <div id="modal-center" class="uk-flex-top" data-uk-modal>
                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

                    <button class="uk-modal-close-default" type="button" data-uk-close></button>

                    <form id="comment_form" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
                        @csrf
                        <fieldset class="uk-fieldset">

                            <legend class="uk-legend">Добавить коментарий</legend>

                            <input id="message_id" name="parent_id" type="hidden">

                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" data-uk-icon="icon: user"></span>
                                    <input name="user_name" class="uk-input" type="text"
                                           placeholder="User name" aria-label="Input"
                                           required >
                                </div>
                            </div>

                            {{--@error('email')
                            <div class="uk-alert-danger uk-margin-small" data-uk-alert>
                                <a class="uk-alert-close" data-uk-close></a>
                                <p>{{ $message }}</p>
                            </div>
                            @enderror--}}

                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" data-uk-icon="icon: mail"></span>
                                    <input id="email" name="email"
                                           class="uk-input" type="text"
                                           placeholder="E-mail" aria-label="E-mail"
                                           required >
                                </div>
                            </div>

                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" data-uk-icon="icon: link"></span>
                                    <input name="home_page"
                                           class="uk-input" type="text"
                                           placeholder="Home page" aria-label="Home page">
                                </div>
                            </div>

                            <div class="uk-margin">
                            <textarea name="comment"
                                      class="uk-textarea" rows="5"
                                      placeholder="Textarea" aria-label="Textarea"
                                      required></textarea>
                            </div>

                            <div class="uk-margin" >
                                <div data-uk-form-custom="target: true">
                                    <input name="fileToUpload" type="file" aria-label="Custom controls" accept=".jpg, .jpeg, .png, .gif, .txt">
                                    <input class="uk-input uk-width-1-1" type="text" placeholder="Select file" aria-label="Custom controls" disabled>
                                </div>
                                {{--<button class="uk-button uk-button-default">Submit</button>--}}
                            </div>

                            <div class="uk-margin">
                                <button class="uk-button uk-button-secondary uk-width-1-1"
                                        type="submit">
                                    Сохранить
                                </button>
                            </div>

                        </fieldset>
                    </form>

                </div>
            </div>
            {{-- /modal form --}}

            {{--@foreach($comments as $item)--}}
            @include('comment')
            {{--@endforeach--}}

        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Документ загружен!");
    });

    // let form = document.getElementById("comment_form");
    // form.addEventListener("submit", (event) => {
    //     event.preventDefault();
    //     console.log('проверка формы');
    //
    //     let email = document.getElementById('email').value;
    //     const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //
    //     console.log(emailPattern.test(email));
    //
    // });

    function answer(messageId) {
        console.log('ответить на сообщение ' + messageId);
        document.getElementById('message_id').value = messageId;
        //const modal = document.getElementById("modal-center");
    }

    function validateForm() {
        console.log('проверка формы перед отправкой');

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let email = document.getElementById("email").value;
        console.log(emailPattern.test(email));

        if (emailPattern.test(email)) {
            return true;
        } else {
            document.getElementById("email").style.borderColor = "red";
            return false;
        }

    }

</script>
@endsection
