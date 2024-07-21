<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">
<style>
    :root {
        --color-1: #ffffff;
        /*white*/
        --color-2: #023fd8;
        /* ccc blue */
        --color-3: #00104D;
        /* lms blue */
        --color-4: #000000;
    }

    body {
        font-family: 'Raleway', sans-serif;
    }

    .bg-primary {
        background-color: var(--color-3) !important;
    }

    #nav-main {
        background-color: var(--color-3);
    }

    .nav-img-brand {
        height: 50px;
    }


    .nav-link {
        color: var(--color-1);
    }

    .nav-link:hover,
    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link.show {
        color: var(--color-2);
    }

    .navbar-nav .nav-link.active {
        color: var(--color-1);
        font-weight: bold;
    }

    .navbar-nav {
        --bs-nav-link-hover-color: var(--color-1);
    }

    .btn-primary {
        background-color: var(--color-3);
        border-color: var(--color-3);
    }

    footer {
        background-color: var(--color-3);
        color: var(--color-1);
    }

    footer ul li a {
        color: var(--color-1);
    }

    footer a {
        color: var(--color-1);
    }

    .bs-icon.bs-icon-primary {
        color: var(--color-1);
        background: var(--color-3);
    }

    .page-link.active,
    .active>.page-link {
        z-index: 3;
        color: var(--color-1);
        background-color: var(--color-3);
        border-color: var(--color-1);
    }

    .page-link {
        color: var(--color-3);
    }

    #carousel-1 {
        font-weight: 600;
    }

</style>