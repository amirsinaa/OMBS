<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('libs/jquery.easing.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/home_bundle.css') }}">
  </head>
  <body id="page-top">
    <nav class="py-3 navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="my-2 ml-auto navbar-nav my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">Features</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#TechStack">Tech Stack</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="/register">Register </a></li>

                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead">
        <div class="container h-100">
            <div class="text-center row h-100 align-items-center justify-content-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-white text-uppercase font-weight-bold">OMBS - Online Medicine Bidding System</h1>
                    <hr class="my-4 divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="mb-5 text-white-75 font-weight-light">For Pharmacies</p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Features</a>
                </div>
            </div>
        </div>
    </header>
    <section class="page-section bg-primary" id="about">
        <div class="container">
          <div class="row justify-content-center">
            <div class="text-center col-lg-8">
              <h2 class="mt-0 text-white">About</h2>
              <hr class="my-4 divider light" />
              <p class="mb-4 text-justify text-white-50">
                  OMBS is a solution to prevent drug wastage and expiration. It is a smart commercial platform for pharmacies around the world to buy and purchase drugs, especially drugs that are nearing expiration date. The main motivation for establishing OMBS was environmental protection. Chemicals, plastics and other materials made from the decomposition of obsolete drugs can be dumped into the oceans. With OMBS, pharmacies can manage and track the course of treatment and trade it manually or automatically with other pharmacies that have a specific drug shortage.
              </p>
              <br>
              <br>
              <h3 class="mt-0 text-white">Some Features</h3>
              <hr class="my-4 divider light" />
              <div class="row">
                <div class="text-center col-md-3">
                  <div class="mt-2">
                    <h3 class="mb-1 text-white h5">Bid System</h3>
                    <p class="mb-0 text-muted"></p>
                  </div>
                </div>
                <div class="text-center col-md-3">
                  <div class="mt-2">
                    <h3 class="mb-1 text-white h5">Admin panel</h3>
                    <p class="mb-0 text-muted"></p>
                  </div>
                </div>
                <div class="text-center col-md-3">
                  <div class="mt-2">
                    <h3 class="mb-1 text-white h5">Chat system</h3>
                    <p class="mb-0 text-muted"></p>
                  </div>
                </div>
                <div class="text-center col-md-3">
                  <div class="mt-2">
                    <h3 class="mb-1 text-white h5">Re-sell medicines</h3>
                    <p class="mb-0 text-muted"></p>
                  </div>
                </div>
              </div>
              <div class="my-4 row"></div>
              <a class="btn btn-light btn-xl js-scroll-trigger" href="#TechStack">Tech Stack</a>
            </div>
          </div>
        </div>
    </section>
    <section id="screenshots" class="page-section bg-light">
      <div class="container">
        <div class="row">
          <h3 class="mt-0 text-center text-black col-12">Some Screenshots</h3>
          <hr class="my-4 text-center divider dark col-12" />
          <div class="mt-3 row">
            <div class="text-center col-md-3">
              <a href="#screenShotImage1">
                <img src="design/1.jpg" class="img-fluid h-100 w-100" alt="ombs 1">
              </a>
              <a href="#" class="screen-shot-image-lightbox" id="screenShotImage1">
                <img src="design/1.jpg" class="img-fluid h-100 w-100" alt="ombs 1">
              </a>
            </div>
            <div class="text-center col-md-3">
              <a href="#screenShotImage2">
                <img src="design/2.jpg" class="img-fluid h-100 w-100" alt="ombs 2">
              </a>
              <a href="#" class="screen-shot-image-lightbox" id="screenShotImage2">
                <img src="design/2.jpg" class="img-fluid h-100 w-100" alt="ombs 2">
              </a>
            </div>
            <div class="text-center col-md-3">
              <a href="#screenShotImage3">
                <img src="design/3.jpg" class="img-fluid h-100 w-100" alt="ombs 3">
              </a>
              <a href="#" class="screen-shot-image-lightbox" id="screenShotImage3">
                <img src="design/3.jpg" class="img-fluid h-100 w-100" alt="ombs 3">
              </a>
            </div>
            <div class="text-center col-md-3">
              <a href="#screenShotImage4">
                <img src="design/4.jpg" class="img-fluid h-100 w-100" alt="ombs 4">
              </a>
              <a href="#" class="screen-shot-image-lightbox" id="screenShotImage4">
                <img src="design/4.jpg" class="img-fluid h-100 w-100" alt="ombs 4">
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="page-section" id="TechStack">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center col-lg-8">
                    <h2 class="mt-0 text-dark">Tech Stack</h2>
                    <hr class="my-4 divider dark" />
                </div>
            </div>
            <div class="row">
                <div class="text-center col-lg-3 col-md-6">
                    <div class="mt-5">
                        <i class="mb-4 fas fa-4x fa-gem text-primary"></i>
                        <h3 class="mb-2 h4">Laravel</h3>
                        <p class="mb-0 text-muted">Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model???view???controller architectural pattern and based on Symfony</p>
                    </div>
                </div>
                <div class="text-center col-lg-3 col-md-6">
                    <div class="mt-5">
                        <i class="mb-4 fas fa-4x fa-laptop-code text-primary"></i>
                        <h3 class="mb-2 h4">Vuejs</h3>
                        <p class="mb-0 text-muted">Vue.js is an open-source model???view???viewmodel front end JavaScript framework for building user interfaces and single-page applications. It was created by Evan You, and is maintained by him and the rest of the active core team members.</p>
                    </div>
                </div>
                <div class="text-center col-lg-3 col-md-6">
                    <div class="mt-5">
                        <i class="mb-4 fas fa-4x fa-globe text-primary"></i>
                        <h3 class="mb-2 h4">Mysql</h3>
                        <p class="mb-0 text-muted">MySQL is an open-source relational database management system. Its name is a combination of "My", the name of co-founder Michael Widenius's daughter, and "SQL", the abbreviation for Structured Query Language.</p>
                    </div>
                </div>
                <div class="text-center col-lg-3 col-md-6">
                    <div class="mt-5">
                        <i class="mb-4 fas fa-4x fa-heart text-primary"></i>
                        <h3 class="mb-2 h4">Sass</h3>
                        <p class="mb-0 text-muted">Sass is a preprocessor scripting language that is interpreted or compiled into Cascading Style Sheets. SassScript is the scripting language itself. Sass consists of two syntaxes. The original syntax, called "the indented syntax," uses a syntax similar to Haml.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-white page-section bg-dark">
        <div class="container text-center">
            <h2 class="mb-4">OMBS - Online Medicine Bidding System</h2>
            <a class="btn btn-light btn-xl" href="/register">Register </a>
        </div>
    </section>
    <footer class="py-5 bg-light">
        <div class="container"><div class="text-center small text-muted">Copyright ?? 2020 - OMBS</div></div>
    </footer>
    <script>
      (function($) {
            $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                    scrollTop : (target.offset().top - 72)
                    }, 1000, "easeInOutExpo");
                    return false;
                }
                }
            });
            $('.js-scroll-trigger').click(function() {
                $('.navbar-collapse').collapse('hide');
            });
            var navbarCollapse = function() {
                if ($("#mainNav").offset().top > 100) {
                $("#mainNav").addClass("navbar-scrolled");
                } else {
                $("#mainNav").removeClass("navbar-scrolled");
                }
            };
            navbarCollapse();
            $(window).scroll(navbarCollapse);
            })(jQuery);
    </script>
  </body>
</html>
