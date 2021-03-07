<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light white">
    <div class="container">
        <img src="/views/assets/img/logo.png" class="navbar-brand" height="64">

        <ul class="navbar-nav">
            <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="/home"><i class="fal fa-home"></i> Home
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="/challenges"><i class="fal fa-flag"></i> Challenges</a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="/scoreboard"><i class="fal fa-list"></i> Scoreboard</a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a class="nav-link" href="/contact"><i class="fal fa-id-card"></i> Contact</a>
            </li>
        </ul>
        <?php

        if (isset($_SESSION['login'])) {
        ?>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown show">
                    <a href="/me" class="nav-link">
                        <div class="d-flex flex-row align-items-center justify-content-center">
                            <div class="text-right mr-2" style="line-height:15px;">Score<br>
                                <span class="pn-text" id="point">loading...</span>
                            </div>
                            <img src="/views/assets/img/icon.png" width="48" height="48" class="rounded-circle">
                        </div>
                    </a>
                </li>
            </ul>

        <?php
        }else{
            echo '<ul class="navbar-nav ml-auto"></ul>';
        }

        ?>
    </div>
</nav>
<script>
var login = '<?php
echo (isset($_SESSION['login']) ? $_SESSION['login'] : '');
?>';
</script>