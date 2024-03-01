<template>
    <section
        id="footer"
        class="mt-5 container-fluid"
        style="position: relative"
    >
        <div class="shap overflow: hidden"></div>
        <!-- Footer -->
        <footer class="text-white text-center text-md-start">
            <!-- Grid container -->

            <div class="container p-4">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <img
                            src="@/assets/image/Logo.svg"
                            class="mb-4"
                            width="300"
                        />

                        <p class="text-center text-md-start pr">
                            We provide cloud solution platform to help you
                            manage your dental clinic products stock and newest
                            courses to learn more about dental, Also we provide
                            a consultants team to guide you how to start your
                            clinic or your new business.
                        </p>
                        <div
                            class="d-flex gap-4 mt-5 mb-4 justify-content-center justify-content-md-start"
                        >
                            <a class="text-secondary" href=""
                                ><font-awesome-icon
                                    icon="fa-brands fa-facebook"
                                    size="2x"
                                    fixed-width
                            /></a>
                            <a class="text-secondary" href=""
                                ><font-awesome-icon
                                    icon="fa-brands fa-twitter"
                                    size="2x"
                                    fixed-width
                            /></a>
                            <a class="text-secondary" href=""
                                ><font-awesome-icon
                                    icon="fa-brands fa-instagram"
                                    size="2x"
                                    fixed-width
                            /></a>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                        <h5 class="mb-4">Property</h5>

                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                            <li>
                                <a
                                    href="#aboutus"
                                    class="text-secondary"
                                    style="text-decoration: none"
                                    >About us</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#ourservices"
                                    class="text-secondary"
                                    style="text-decoration: none"
                                    >Our Services</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#ourstory"
                                    class="text-secondary"
                                    style="text-decoration: none"
                                    >Our Story</a
                                >
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="mb-4">Contact</h5>

                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                            <li>
                                <a
                                    href="#!"
                                    class="text-secondary"
                                    style="text-decoration: none"
                                    >2464 Royal Ln. Mesa, New Jersey 45463</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#!"
                                    class="text-secondary"
                                    style="text-decoration: none"
                                    >+966 50 535 8306</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#!"
                                    class="text-secondary"
                                    style="text-decoration: none"
                                    >info@hounter.com</a
                                >
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center text-secondary p-3">
                © 2023 Copyright
                <a
                    class="text-secondary"
                    style="text-decoration: none"
                    href="https://www.linkedin.com/in/omar-a-mahran/"
                    >Omar_A_Mahran</a
                >
            </div>

            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </section>
</template>
<style scoped>
a {
    font-weight: normal;
}
.pr {
    width: 85%;
    text-align: justify;
}
.shap {
    bottom: 0;
    right: 0;
    position: absolute;
    width: 338px;
    height: 394px;
    transform: rotate(90deg);
    flex-shrink: 0;

    background: #65c5b9;
    opacity: 0.3;
    filter: blur(60px);
}
@media only screen and (max-width: 991px) {
    .pr {
        width: 100%;
    }
    .shap {
        bottom: 0;
        right: 2px;
    }
}
</style>
