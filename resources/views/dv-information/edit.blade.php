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

        .accordion .container {
            position: relative;
        }

        .accordion hr{
            display: none;
        }

        /* Positions the labels relative to the .container. Adds padding to the top and bottom and increases font size. Also makes its cursor a pointer */

        .accordion .label {
            position: relative;
            cursor: pointer;
            padding: 10px;
            background: #E9EBEB;
            border: 1px solid #808080;
            border-radius: 3px;
        }

        /* Positions the plus sign 5px from the right. Centers it using the transform property. */

        .accordion .label::before {
            content: '+';
            color: black;
            position: relative;
            padding-right: 20px;
        }

        /* Hides the content (height: 0), decreases font size, justifies text and adds transition */

        .accordion .content {
            position: relative;
            height: 0px;
            padding-top: 10px;
            text-align: justify;
            overflow: hidden;
            transition: 0.5s;
        }

        /* Unhides the content part when active. Sets the height */

        .accordion .container.active .content {
            height: 150px;
        }

        /* Changes from plus sign to negative sign once active */

        .accordion .container.active .label::before {
            content: '-';
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
                        <input type="text" name="title" class="form-control" style="font-weight: bold" placeholder="Title" value="What is Domestic Violence?">
                        <br>
                        <textarea>
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
                        </textarea>

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
                        <p>
                            You are not alone. Here are some of your options if you’re experiencing domestic violence.
                            <br><br>
                            Option 1: Use this system emergency feature. We provide efficient way to report your situation by click to the red button with ‘Open Map for Emergency’ if you are got violenced and need immediate help.
                            <br><br>
                            We also provide consultation with our live chat feature.
                            <br><br>
                            Option 2: Go to the "One Stop Crisis Centre" at Government Hospitals
                            <br><br>
                            “One Stop Crisis Centres” (OSCC) are located at emergency rooms of government hospitals. At the OSCC, doctors provide medical treatment for any injury and also collect medical evidence, which can be used in court.
                        </p>
                    </div>

                    <div id="laws" class="tabcontent">
                        <h3>Laws on Domestic Violence</h3>
                        <p>According to the Domestic Violence Act, “domestic violence” means the commission of one or more of the following acts:
                        <ul>
                            <li>wilfully or knowingly placing, or attempting to place, the victim in fear of physical injury;</li>
                            <li>causing physical injury to the victim by such act which is known or ought to have been known would result in physical injury;</li>
                            <li>compelling the victim by force or threat to engage in any conduct or act, sexual or otherwise, from which the victim has a right to abstain;</li>
                            <li>confining or detaining the victim against the victim’s will;</li>
                            <li>causing mischief or destruction or damage to property with intent to cause or knowing that it is likely to cause distress or annoyance to the victim;</li>
                            <li>dishonestly misappropriating the victim’s property which causes</li>
                        </ul>

                        </p>
                    </div>

                    <div id="faq" class="tabcontent">
                        <h3>Domestic Violence Rescue System services FAQ</h3>

                        <div class="accordion-body">
                            <div class="accordion">
                                <hr>
                                <div class="container">
                                    <div class="label">What is HTML</div>
                                    <div class="content">Hypertext Markup Language (HTML) is a computer language that makes up most web pages and online applications. A hypertext is a text that is used to reference other pieces of text, while a markup language is a series of markings that tells web servers the style and structure of a document. HTML is very simple to learn and use.</div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="label">What is CSS?</div>
                                    <div class="content">CSS stands for Cascading Style Sheets. It is the language for describing the presentation of Web pages, including colours, layout, and fonts, thus making our web pages presentable to the users. CSS is designed to make style sheets for the web. It is independent of HTML and can be used with any XML-based markup language. CSS is popularly called the design language of the web.
                                    </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="label">What is JavaScript?</div>
                                    <div class="content">JavaScript is a scripting or programming language that allows you to implement complex features on web pages — every time a web page does more than just sit there and display static information for you to look at — displaying timely content updates, interactive maps, animated 2D/3D graphics, scrolling video jukeboxes, etc. — you can bet that JavaScript is probably involved. It is the third of the web trio.</div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="label">What is React?</div>
                                    <div class="content">React is a JavaScript library created for building fast and interactive user interfaces for web and mobile applications. It is an open-source, component-based, front-end library responsible only for the application’s view layer. In Model View Controller (MVC) architecture, the view layer is responsible for how the app looks and feels. React was created by Jordan Walke, a software engineer at Facebook. </div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="label">What is PHP?</div>
                                    <div class="content">PHP is a server-side and general-purpose scripting language that is especially suited for web development. PHP originally stood for Personal Home Page. However, now, it stands for Hypertext Preprocessor. It’s a recursive acronym because the first word itself is also an acronym.</div>
                                </div>
                                <hr>
                                <div class="container">
                                    <div class="label">What is Node JS?</div>
                                    <div class="content">Node.js is an open-source, cross-platform, back-end JavaScript runtime environment that runs on the V8 engine and executes JavaScript code outside a web browser. Node.js lets developers use JavaScript to write command line tools and for server-side scripting—running scripts server-side to produce dynamic web page content before the page is sent to the user's web browser. Consequently, Node.js represents a "JavaScript everywhere" paradigm</div>
                                </div>
                                <hr>
                            </div>
                        </div>
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
    <script>
        const accordion = document.getElementsByClassName('container');

        for (i=0; i<accordion.length; i++) {
            accordion[i].addEventListener('click', function () {
                this.classList.toggle('active')
            })
        }
    </script>
    <script src="https://cdn.tiny.cloud/1/1tf6nfno3yi47i0rna6sogpqmrg2v0f8w12xpt60aegwbhq6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            menubar: false,
            plugins: [ 'quickbars' ],
            toolbar: 'undo redo | bold italic underline strikethrough | numlist bullist',
            mobile: {
                menubar: true
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/nav.js') }}"></script>
    </body>
@endsection
