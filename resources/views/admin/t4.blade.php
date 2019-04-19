<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="/css/app.css">

</head>
<body>


<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">


        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">


                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#item-1">Item 1</a>
                        <div id="item-1" class="collapse">
                            <ul class="nav flex-column ml-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Sub 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Sub 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Sub 3</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Item 2</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#item-3">Item 3</a>
                        <div id="item-3" class="collapse">
                            <ul class="nav flex-column ml-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Sub 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Sub 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Sub 3</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                </ul>


            </div>
        </nav>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

            <h2>Section title</h2>

        </main>


    </div>
</div>


<!-- JavaScript files-->
<script src="/js/app.js"></script>
</body>
</html>