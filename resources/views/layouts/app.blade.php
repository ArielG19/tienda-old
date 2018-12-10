<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
   
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/product') }}">
                    Tienda
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}"></a></li>
                    <li><a href="{{ url('/productos') }}">Agregar productos</a></li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('product.shoppingcart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Shoppin cart <span class="badge">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span></a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                            role="button" aria-expanded="false" style="position: relative;padding-left: 50px;">
                                
                            <img src="uploads/avatars/{{Auth::user()->avatar}}" style="width: 32px; height: 32px; position:absolute; top: 10px; left: 10px;border-radius: 50%">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                            <!--perfil-->
                                     <li>
                                        <a href="{{ url('/profile') }}">                                      
                                             <i class="fa fa-user" aria-hidden="true"></i>
                                              Perfil
                                        </a>
                                     </li>
                                     <li>
                                        
                                         <a href="{{ url('/logout') }}">
                                             <i class="fa fa-btn fa-sign-out"></i>
                                             Logout</a>
                                     </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
   
     <!--script locales-->
    <script type="text/javascript" src="/jquery/jquery.js"></script>
    <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="{{ URL::to('src/js/checkout.js') }}"></script>
    @yield('content')
    @yield('script')
</body>
</html>
