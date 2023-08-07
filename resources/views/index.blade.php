@extends('layout.main')

@section('title', 'My home page')
@section('description', 'My page description')
@section('keywords', 'myKeyword1, myKeyword2, myKeyword3')

@section('content')
    <div class="uk-section uk-section-small uk-section-muted" style="height: 100vh;">
        <div class="uk-container uk-container-xlarge uk-margin-bottom">

            @php
                var_dump($_POST);
            @endphp

            <a class="uk-button uk-button-secondary uk-margin-bottom" href="#modal-center" data-uk-toggle>Добавить коментарий</a>

            <div id="modal-center" class="uk-flex-top" data-uk-modal>
                <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

                    <button class="uk-modal-close-default" type="button" data-uk-close></button>

                    <form method="post" action="">
                        @csrf
                        <fieldset class="uk-fieldset">

                            <legend class="uk-legend">Добавить коментарий</legend>

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
                                    <input name="email" class="uk-input" type="text"
                                           placeholder="E-mail" aria-label="E-mail"
                                           required >
                                </div>
                            </div>

                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" data-uk-icon="icon: link"></span>
                                    <input  name="home_page" class="uk-input" type="text"
                                            placeholder="Home page" aria-label="Home page">
                                </div>
                            </div>

                            <div class="uk-margin">
                            <textarea class="uk-textarea" rows="5" placeholder="Textarea" aria-label="Textarea"
                                      required></textarea>
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

            {{--<div class="uk-flex uk-flex-center uk-margin-bottom">
                <div class="uk-card uk-card-default uk-card-body uk-width-1-2">
                    <form method="post" action="">
                        @csrf
                        <fieldset class="uk-fieldset">

                        <legend class="uk-legend">Добавить коментарий</legend>

                        <div class="uk-margin">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" data-uk-icon="icon: user"></span>
                                <input name="user_name" class="uk-input" type="text"
                                       placeholder="User name" aria-label="Input"
                                       required >
                            </div>
                        </div>

                        --}}{{--@error('email')
                        <div class="uk-alert-danger uk-margin-small" data-uk-alert>
                            <a class="uk-alert-close" data-uk-close></a>
                            <p>{{ $message }}</p>
                        </div>
                        @enderror--}}{{--

                        <div class="uk-margin">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" data-uk-icon="icon: mail"></span>
                                <input name="email" class="uk-input" type="text"
                                       placeholder="E-mail" aria-label="E-mail"
                                       required >
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" data-uk-icon="icon: link"></span>
                                <input  name="home_page" class="uk-input" type="text"
                                        placeholder="Home page" aria-label="Home page">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <textarea class="uk-textarea" rows="5" placeholder="Textarea" aria-label="Textarea"
                                      required></textarea>
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
            </div>--}}

            <div class="uk-card uk-card-default uk-width-1-1">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" data-uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-border-circle" width="40" height="40" src="{{ asset('img/avatar.jpg') }}" alt="Avatar">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">Title</h3>
                            <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">April 01, 2016</time></p>
                        </div>
                        <div class="uk-width-auto">
                            <a class="uk-button uk-button-text" href="#modal-center" data-uk-toggle>Ответить</a>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
                </div>
                {{--<div class="uk-card-footer">
                    <a href="#" class="uk-button uk-button-text">Read more</a>
                </div>--}}
            </div>

        </div>
    </div>
@endsection
