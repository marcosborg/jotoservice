<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
    <div class="container"><a class="navbar-brand logo" href="/"><img src="{{ asset('assets/website/img/logo-r.svg') }}"
                style="height: 44px;width: 200px;"></a><button data-bs-toggle="collapse" class="navbar-toggler"
            data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown"><a class="nav-link {{ request()->is('tvde/aluguer-de-viaturas') || 
                        request()->is('tvde/consultadoria') || 
                        request()->is('tvde/formacao') ? 'active' : '' }}" aria-expanded="false"
                        data-bs-toggle="dropdown" href="#">TVDE <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/tvde/aluguer-de-viaturas">Aluguer de
                            viaturas</a>
                        <a class="dropdown-item" href="/tvde/formacao">Formação</a>
                        <a class="dropdown-item" href="/tvde/consultadoria">Consultadoria</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link {{ request()->is('tvde/estafetas') ? 'active' : '' }}"
                        href="/tvde/estafetas">Estafetas</a></li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('tvde/transfers-tours') ? 'active' : '' }}"
                        href="/tvde/transfers-tours">Transfer´s e
                        Tours</a>
                </li>
                <li class="nav-item">
                    <a href="/tvde/stand" class="nav-link {{ request()->is('tvde/stand') ? 'active' : '' }}">Stand</a>
                </li>
                <li class="nav-item">
                    <a href="/tvde/trabalhar-com-viatura-propria"
                        class="nav-link {{ request()->is('tvde/trabalhar-com-viatura-propria') ? 'active' : '' }}">Trabalhar
                        com viatura
                        própria</a>
                </li>
                <!--
                        <li class="nav-item"><a class="nav-link {{ request()->is('loja/acessorios') ? 'active' : '' }}"
                        href="/loja/acessorios">Acessórios</a></li>
                        -->
                <li class="nav-item dropdown">
                    <a href="#"
                        class="nav-link {{ request()->is('pagina/1/sobre-nos') || request()->is('pagina/2/parceiros') || request()->is('pagina/3/contactos') ? 'active' : '' }}"
                        aria-expanded="false" data-bs-toggle="dropdown">A empresa <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        @foreach (App\Models\Page::all() as $page)
                        <a class="dropdown-item"
                            href="/pagina/{{ $page->id }}/{{ Illuminate\Support\Str::slug($page->title, '-') }}">{{
                            $page->title }}</a>
                        @endforeach
                    </div>
                </li>
                @auth
                <li class="nav-item dropdown"><a class="nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                        href="#"><i class="fas fa-lock"></i> <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu"><a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</a><a
                            class="dropdown-item" href="/admin">Área reservada</a></div>
                </li>
                @else
                <li class="nav-item dropdown"><a class="nav-link" aria-expanded="false" data-bs-toggle="dropdown"
                        href="#"><i class="fas fa-lock-open"></i> <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu"><a class="dropdown-item" href="/login">Login</a><a class="dropdown-item"
                            href="/register">Criar conta</a></div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>