<template>
  <section class="mt-5" style="position: relative">
    <!-- Footer -->
    <footer class="text-white text-center text-md-start">
      <!-- Grid container -->

      <div class="container p-4">
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
            <div class="d-flex align-items-center">
              <div>
                <img src="@/assets/image/phoneicon.svg" class="me-2 mb-3" />
              </div>

              <div>
                <p style="font-weight: 300; font-size: 25px">
                  Get in touch with
                </p>
              </div>
            </div>

            <a
              class="btn btn-primary"
              href="tel:+919885345581"
              style="text-decoration: none; font-weight: bold; font-size: 25px"
              ><p style="color: white">+91 98853 45581</p></a
            >
            <div class="d-flex flex-column mt-5">
              <a href="www.mittarv.com" style="color: #1d617a"
                >www.mittarv.com</a
              >
              <a
                href="mailto: vishal@mittarv.com"
                style="color: #1d617a; text-decoration: none"
              >
                vishal@mittarv.com</a
              >
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="mb-4">
              <img
                src="@/assets/image/Iconwind.svg"
                class="me-2 align-items-center"
              />Pages
            </h5>

            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >Home</a
                >
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >About us</a
                >
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >Services</a
                >
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >Contact Us</a
                >
              </li>
            </ul>
          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="mb-4">
              <img
                src="@/assets/image/Iconpen.svg"
                class="me-2 align-items-center"
              />Features
            </h5>

            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >Service Request
                </a>
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >Customer Service</a
                >
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                >
                  My Request</a
                >
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                >
                  My Med-Verse</a
                >
              </li>
            </ul>
          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
            <h5 class="mb-4">
              <img
                src="@/assets/image/Iconsound.svg"
                class="me-2 align-items-center"
              />Follows
            </h5>

            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >Facebook</a
                >
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >Twitter</a
                >
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                >
                  Instagram
                </a>
              </li>
              <li>
                <a
                  href="#!"
                  class="text-secondary"
                  style="text-decoration: none"
                  >LinkedIn</a
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
          href="https://mdbootstrap.com/"
          >Omar_A_Mahran</a
        >
      </div>

      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </section>
</template>
<style scoped>
footer {
  background-color: #d6efeb;
}
a {
  font-weight: normal;
}
.btn-primary {
  border-radius: 5px;
  padding-left: 20px;
  padding-right: 20px;
}
.pr {
  width: 85%;
  text-align: justify;
}
h1,
h2,
h3,
h4,
h5,
h6,
p {
  color: #1d617a;
}
.shap {
  z-index: -1;
  bottom: 0;
  right: 0;
  position: absolute;

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
    width: 138px !important;
  }
}
</style>
