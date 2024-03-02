<template>
    <nav class="navbar navbar-expand-lg pt-5" style="z-index: 9999">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"
                ><img
                    src="@/assets/image/Logo.svg"
                    width="200"
                    class="white-fill"
            /></a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul
                    class="navbar-nav ms-auto mb-2 mb-lg-0 justify-content-center align-items-center"
                >
                    <!-- <li class="nav-item">
            <a class="nav-link primarycolor" aria-current="page" href="#"
              >Home</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link primarycolor" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link primarycolor me-4 res" href="#">Services</a>
          </li> -->
                    <li class="nav-item">
                        <a class="nav-link seccolor me-4 res" href="#aboutus"
                            >About Us</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="#ourservices"
                            class="nav-link seccolor me-4 res"
                            >Services</a
                        >
                    </li>
                    <li class="">
                        <a href="#ourstory" class="nav-link seccolor me-4 res"
                            >Our Story</a
                        >
                    </li>
                    <li class="nav-item">
                        <a href="#footer" class="nav-link seccolor me-4 res"
                            >Contact Us</a
                        >
                    </li>

                    <div>
                        <a
                            v-if="islogin == true"
                            href="admin"
                            class="nav-link seccolor me-4 res"
                            >Dashboard</a
                        >
                        <div v-if="!islogin" class="d-flex">
                            <li class="nav-item">
                                <a href="login" class="nav-link me-4 ress">
                                    Login</a
                                >
                            </li>
                            <li class="nav-item">
                                <a href="register" class="nav-link me-4 ress"
                                    >Register</a
                                >
                            </li>
                        </div>
                    </div>
                    <!-- <li class="nav-item me-4 res">
            <a class="nav-link btn btn-primary text-white botto" href="#"
              >Register</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary text-white botto" href="#"
              >Login</a
            >
          </li> -->
                </ul>
            </div>
        </div>
    </nav>
</template>
<script setup>
let islogin = window.Laravel.isLoggedin;
let user = window.Laravel.user ?? null;
</script>
<style scoped>
.white-fill {
    filter: brightness(0) invert(1) saturate(100%) brightness(100%)
        grayscale(0%);
}
.res {
    border-radius: 25px;
    font-size: 16px !important;
    border: 1px solid #ffffff !important;
    color: #ffffff !important;
}
.res:hover {
    background-color: #1d617a !important;
    border: 1px solid #1d617a !important;
}

@media only screen and (max-width: 991px) {
    .collapse .navbar-collapse {
        z-index: 999999;
    }
    .navbar-collapse {
        background-color: #1d617a !important;
        border-radius: 25px;
        margin-top: 10px;
    }
    .navbar-toggler,
    .navbar-toggler-icon {
        color: white !important;
        background-color: white;
    }
    .botto {
        width: 150px;
        margin: 10px;
    }
    .res {
        margin-left: 20px;
        margin-bottom: 6px;
        border: none !important;
        font-size: 20px !important;
    }
}
</style>
