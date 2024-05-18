<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1f1f1f;">
        <div class="container-fluid">
            @auth
                <a class="navbar-brand" href="{{ route('projects.index') }}">家計簿</a>
            @else
                <a class="navbar-brand" href="/">家計簿</a>
            @endauth

            <!-- ナビゲーションのトグルボタン -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- ナビゲーションメニュー -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav mr-3">
                    <!-- 戻るボタン -->
                    <button type="button" class="nav-link btn btn-sm btn-info text-light btn-block" onClick="history.back()">戻る</button>
                </div>

                @auth
                    <a class="mr-lg-3 my-lg-0 my-3 btn btn-sm btn-info text-light nav-item nav-link" href="#">{{ Auth::user()->name }}</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger text-light nav-item nav-link w-100">ログアウト</button>
                    </form>
                @else
                    <a class="mr-lg-3 my-lg-0 my-3 btn btn-sm btn-info text-light nav-item nav-link" href="{{ route('login') }}">ログイン</a>
                    <a class="btn btn-sm btn-primary text-light nav-item nav-link" href="{{ route('register') }}">新規登録</a>
                @endauth
            </div>
        </div>
    </nav>
</header>
