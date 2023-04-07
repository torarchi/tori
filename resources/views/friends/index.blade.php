@extends('layouts.default')

@section('content')

    <style>

        button {
            background-color: white;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button.active {
            background-color: black;
            color: white;
        }

        .main {
            margin-top: 25px;
        }

        .col-lg-12 {
            width: 100%;
        }

        @media screen and (min-width: 768px) {
            .col-lg-12 {
                width: 50%;
            }
        }

        @media screen and (min-width: 992px) {
            .col-lg-12 {
                width: 33.33%;
            }
        }

    </style>

    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

    <div class="main">
        <div class="row">
            <div class="col-lg-12">
                <button id="button-1" class="active">Ваши друзья</button>
                <button id="button-2">Запросы в друзья</button>

                <div id="div-1">
                    @if(!$friendsPage->count())
                        <p>У вас пока нет друзей</p>
                    @else
                        @foreach($friendsPage as $user)
                            @include('user.components.userblock')
                        @endforeach
                    @endif
                </div>

                <div id="div-2">
                    @if(!$frequests->count())
                        <p>У вас нет запросов в друзья</p>
                    @else
                        @foreach($frequests as $user)
                            @include('user.components.userblock')
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#div-2').hide();

            // Set the default state of the buttons and divs
            $('#button-1').addClass('active');
            $('#div-1').show();

            // Toggle the content of div 1 when button-1 is clicked
            $('#button-1').click(function() {
                $('#div-1').show();
                $('#div-2').hide();
                $('#button-1').addClass('active');
                $('#button-2').removeClass('active');
            });

            // Toggle the content of div 2 when button-2 is clicked
            $('#button-2').click(function() {
                $('#div-2').show();
                $('#div-1').hide();
                $('#button-2').addClass('active');
                $('#button-1').removeClass('active');
            });
        });
    </script>

@endsection
