<x-layouts::archinest>

    <!-- 404 Section -->
    <section class="">
        <div class="auto-container pt-120 pb-70">
            <div class="row">
                <div class="col-xl-12">
                    <div class="error-page__inner">
                        <div class="error-page__title-box">
                            <img src="images/resource/404.jpg" alt="">
                            <h3 class="error-page__sub-title">Page non trouvée!</h3>
                        </div>
                        <p class="error-page__text">Désolé, cetta page n'esxiste pas ou <br> est en construction.</p>
                        <form class="error-page__form">
                            <div class="error-page__form-input">
                                <input class="form-control" type="search" placeholder="Search here">
                                <button type="submit"><i class="lnr lnr-icon-magnifier"></i></button>
                            </div>
                        </form>
                        <a href="{{ route('home2') }}" class="theme-btn btn-style-one shop-now"><span class="btn-title">
                                Retour à l'accueil
                            </span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End 404 Section -->
</x-layouts::archinest>