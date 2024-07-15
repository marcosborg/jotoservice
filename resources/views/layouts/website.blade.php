<!DOCTYPE html>
<html>

<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FRCP4DSMFT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FRCP4DSMFT');
</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ExpertCom - @yield('title', 'Tudo o que precisa saber sobre transportes urbanos.')</title>
    <meta name=”description” content="@yield('description', 'Tudo o que precisa saber para se lançar neste negócio apaixonante dos transportes urbanos TVDE. Como e por onde começar?')" />
    <link rel="stylesheet" href="{{ asset("assets/website/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
        <script src="https://kit.fontawesome.com/4f969e7a23.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="{{ asset("assets/website/css/vanilla-zoom.min.css") }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/website/css/custom.css?v=' . rand()) }}">
</head>

<body>
    <x-menu />
    <main class="page landing-page">
        @yield('content')
        <section class="py-4 py-xl-5">
            <div class="container">
                <div
                    class="text-white bg-dark border rounded border-0 border-light d-flex flex-column justify-content-between align-items-center flex-lg-row p-4 p-lg-5">
                    <div class="text-center text-lg-start py-3 py-lg-1">
                        <h2 class="fw-bold mb-2"><strong>Subscreva a nossa newsletter</strong></h2>
                        <p class="mb-0">Conheça as novidades do ExpertCom</p>
                    </div>
                    <form class="d-flex justify-content-center flex-wrap my-2" method="post" id="newsletter" action="/forms/newsletter">
                        @csrf
                        <div class="my-2"><input class="form-control" type="email" name="email"
                                placeholder="O seu email"></div>
                        <div class="my-2"><button class="btn btn-primary ms-sm-2" type="submit">Subscrever</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <x-footer />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset("assets/website/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset("assets/website/js/vanilla-zoom.js") }}"></script>
    <script src="{{ asset("assets/website/js/theme.js?v=" . rand()) }}"></script>
</body>

</html>