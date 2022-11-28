@extends('layouts.header')

@section('content')
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/content-styles.css')}}">
    <!-- Favicon -->
    @include('nav.favicon')
    <!-- Favicon -->
    <!-- navbar
    ================================================== -->
    @include('nav.navbar')
    <!-- navbar
    ================================================== -->
    <style>
        /* Style the tab */
        .dvinfo {
            display: inline-block;
        }

        .tab {
            overflow: hidden;
            display: inline-block;
            border-bottom: 2px dotted #000;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 86px 14px 0;
            transition: 0.3s;
            font-size: 17px;
            color: #000000B2;
            width: auto;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            color: #000;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            color: #000;
            font-weight: bold;
            margin-bottom: -3px;

        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            width: 800px;
            border-top: none;
            margin: 0 auto;
            text-align: justify;
            -webkit-animation: fadeEffect 1s;
            animation: fadeEffect 1s;
        }

        /* Fade in tabs */
        @-webkit-keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeEffect {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @media screen and (max-width: 500px) {
            .tabcontent {
                width: 100px;
            }
        }
    </style>
    </head>
    <body>
    <!-- EXIT BUTTON -->
    @include('nav.exit')
    <!-- EXIT BUTTON -->
    <div class="col mx-auto my-auto">
        <div class="card card-2">
            <div class="container pt-5">
                <h2>Domestic Violence information and safety planning</h2>
                <div class="dvinfo">
                    <div class="tab">
                        <button class="tablinks" onclick="tabName(event, 'intro')" id="defaultOpen">Introduction</button>
                        <button class="tablinks" onclick="tabName(event, 'safe')">Staying Safe</button>
                        <button class="tablinks" onclick="tabName(event, 'help')">Getting help</button>
                        <button class="tablinks" onclick="tabName(event, 'laws')">Laws</button>
                        <button class="tablinks" onclick="tabName(event, 'faq')">FAQ</button>
                    </div>

                    <div id="intro" class="tabcontent">
                        <h3>What is Domestic Violence?</h3>
                        <p>
                            Domestic violence is a pattern of violence, abuse, or intimidation used to control or
                            maintain power over a partner who is or has been in an intimate relationship. Fundamentally,
                            domestic violence is about power and control.
                        </p>
                        <p>
                            There are various forms of domestic violence, including physical, emotional, psychological, sexual, social, and financial abuse. Abusers
                            often use more than one form of abuse to invoke fear or coerce a partner into behaving in ways
                            they don’t want to.
                        </p>
                    </div>

                    <div id="safe" class="tabcontent">
                        <h3>Safety when living with an abusive partner</h3>
                        <ul>
                            <li>Identify your partner’s use and level of force so that you can assess the risk of physical danger to you and your children before it occurs.</li>
                            <li>Identify safe areas of the house where there are no weapons and there are ways to escape. If arguments occur, try to move to those areas.</li>
                            <li>Don’t run to where the children are, as your partner may hurt them as well.</li>
                            <li>If violence is unavoidable, make yourself a small target. Dive into a corner and curl up into a ball with your face protected and arms around each side of your head, fingers entwined.</p>
                            </li>
                        </ul>
                    </div>

                    <div id="help" class="tabcontent">
                        <h3>Getting help for Domestic Violence</h3>
                        <p>Tokyo is the capital of Japan.</p>
                    </div>

                    <div id="laws" class="tabcontent">
                        <h3>Laws on Domestic Violence</h3>
                        <p>Tokyo is the capital of Japan.</p>
                    </div>

                    <div id="faq" class="tabcontent">
                        <h3>Domestic Violence Rescue System services FAQ</h3>
                        <p>Tokyo is the capital of Japan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        function tabName(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    </body>
@endsection
