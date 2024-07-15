<footer class="page-footer dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5>Área de utilizador</h5>
                <ul>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Registo</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>ExpertCom</h5>
                <ul>
                    @foreach (App\Models\Page::all() as $page)
                    <li><a href="/pagina/{{ $page->id }}/{{ Illuminate\Support\Str::slug($page->title, '-') }}">{{
                            $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Apoio</h5>
                <ul>
                    <li><a href="/faqs">FAQ</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Legal</h5>
                <ul>
                    @foreach (\App\Models\Legal::all() as $legal)
                    <li><a href="/legal/{{ $legal->id }}/{{ Illuminate\Support\Str::slug($legal->title, '-') }}">{{
                            $legal->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© {{ date('Y') }} Copyright ExpertCom</p>
    </div>
</footer>

<div id="social-floating-button">
    <a target="_blank" href="https://www.facebook.com/expertcom">
        <i class="fa-brands fa-facebook-f"></i>
    </a>
    <a target="_blank" href="https://www.instagram.com/expertcom/">
        <i class="fa-brands fa-instagram"></i>
    </a>
</div>

<style>
    #social-floating-button {
        position: fixed;
        bottom: 40px;
        right: 40px;
        display: flex;
        z-index: 1000;
    }

    #social-floating-button a {
        background-color: #333;
        color: #fff;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 10px;
        text-decoration: none;
    }

    #social-floating-button a:hover {
        background-color: #1DA1F2;
    }

    #social-floating-button i {
        font-size: 18px;
    }
</style>