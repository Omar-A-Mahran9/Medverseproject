<template>
    <section style="position: relative">
        <div class="coverr mb-5">
            <nav
                class="navbar navbar-expand-lg pt-5 mb-5 pb-3"
                style="z-index: 9999"
            >
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
                    <div
                        class="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
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
                                <a class="nav-link seccolor me-4 res" href="#"
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
                                <a
                                    href="#ourstory"
                                    class="nav-link seccolor me-4 res"
                                    >Our Story</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    href="#footer"
                                    class="nav-link seccolor me-4 res"
                                    >Contact Us</a
                                >
                            </li>

                            <div>
                                {{ isLogin }}
                                <a
                                    v-if="islogin == true"
                                    href="admin"
                                    class="nav-link seccolor me-4 res"
                                    >Dashboard</a
                                >
                                <div v-if="!islogin" class="d-flex">
                                    <li class="nav-item">
                                        <a
                                            href="login"
                                            class="nav-link me-4 ress"
                                        >
                                            Login</a
                                        >
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="register"
                                            class="nav-link me-4 ress"
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
            <div class="container-fluid cov pt-5 pb-3">
                <div
                    class="row align-items-center justify-content-center text-center text-md-start"
                    style="margin-bottom: 200px"
                >
                    <div class="col-12 col-lg-7 mb-5" style="z-index: 999">
                        <div class="wi">
                            <h1 class="mb-3">
                                Welcome to Med-verse Cloud Inventory System
                            </h1>
                            <p style="text-align: justify; font-weight: 400">
                                Our Cloud Inventory System is the backbone of
                                your healthcare organization, offering a
                                real-time, comprehensive view of your inventory
                                status. It eliminates the complexities of
                                inventory management, allowing you to
                                effortlessly track, manage, and analyze your
                                stock levels. This leads to significant cost
                                reductions and improved operational efficiency.
                            </p>
                            <p style="text-align: justify; font-weight: 400">
                                Our E-Store serves as your digital marketplace
                                for medical supplies. With an intuitive
                                interface and secure platform, it simplifies
                                procurement processes and ensures you always
                                have what you need when you need it. The E-Store
                                is more than just a supply store; it's a
                                strategic tool for efficient resource
                                management.
                            </p>
                            <button
                                style="border-radius: 10px; width: 200px"
                                class="btn btn-primary mt-4"
                            >
                                Grt started
                                <img
                                    class="ms-3"
                                    src="@/assets/image/arrow.svg"
                                />
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <!-- <img src="@/assets/image/Education.jpeg" width="100%"                         style="border-radius: 25px"
 /> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="inventoryservices">
            <!-- <div class="row align-items-center justify-content-center">
                <div v-for="(service, i) in services" :key="i" class="col mb-5">
                    <div class="card" style="margin: auto">
                        <div class="card-body mt-4 ms-4">
                            <img
                                :src="imageUrl + '/' + service.servicesImg"
                                class="card-img-top mb-4"
                                style="
                                    border-radius: 25px !important;
                                    width: 153px;
                                "
                                alt="..."
                            />

                            <h5 class="card-title mb-2" style="color: #1d617a">
                                {{ service.servicestitle }}
                            </h5>
                            <p
                                class="card-title"
                                style="color: #1d617a; font-size: 16px"
                            >
                                {{ service.description }}
                            </p>
                        </div>
                        <div
                            class="card-footer"
                            style="border: none; background-color: transparent"
                        >
                            <button
                                style="border-radius: 10px; width: 100%"
                                class="btn btn-primary"
                            >
                                {{ service.button
                                }}<img
                                    class="ms-3"
                                    src="@/assets/image/arrow.svg"
                                />
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
            <sectionsix />
        </div>
    </section>
    <footerr />
</template>
<script>
import sectionsix from "@/components/front/home/SectionSix.vue";
import footerr from "@/components/front/academic/InventoryFooter.view.vue";

export default {
    components: {
        sectionsix,
        footerr,
    },
    data() {
        const imageUrl = new URL("../../../assets/image/", import.meta.url);
        const islogin = window.Laravel.isLoggedin;
        const user = window.Laravel.user ?? null;
        var services = [
            {
                servicestitle: "Service Request ",
                description:
                    "Now you can tell us all the dental products you need just by filling out the list with all your clinic missing products.",
                servicesImg: "service1.svg",
                button: "Send Request",
            },
            {
                servicestitle: "Customer Service",
                description:
                    "A Customer/support system for people getting lost or need any help at my med-verse we are here to Guide you.",
                servicesImg: "service2.svg",
                button: "Contact us",
            },
            {
                servicestitle: "My Request",
                description:
                    "We offer you the ability to check all your previous orders requests with knowing their status and all it’s information also you can edit or cancel your request at the first 24h from your ordered date.",

                servicesImg: "service3.svg",
                button: "Check request",
            },
            {
                servicestitle: "MY Med-Verse",
                description: "",
                servicesImg: "service4.svg",
                button: "Get started",
            },
        ];
        return { imageUrl, services, islogin, user };
    },
};
</script>

<style scoped>
.navbar-toggler,
.navbar-toggler-icon {
    color: white !important;
    background-color: white;
}
.cov h1,
p {
    color: white !important;
}
.coverr {
    position: relative;
}

.coverr::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(
        0,
        0,
        0,
        0.3
    ); /* Adjust the last value (0.5) for the overlay opacity */
}

.coverr::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("@/assets/image/inventory.jpeg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    z-index: -1; /* Ensure the background image is behind the overlay */
}

.swal2-container {
    z-index: 999999999999999 !important;
}
.wi {
    width: 80%;
}
.res {
    border-radius: 25px;
    font-size: 16px !important;
    border: 1px solid #1b1c57 !important;
    color: #1b1c57 !important;
}
.res:hover {
    background-color: #1d617a !important;
    border: 1px solid #1d617a !important;
    border: 1px solid #1d617a !important;
    color: #ffffff !important;
}
.card {
    background-color: #d6efeb;
    border-radius: 20px;
    width: 22rem;
    text-align: justify;
    height: 471px;
}
@media screen and (max-width: 992px) {
    .navbar-collapse {
        background-color: #1d617a !important;
        border-radius: 25px;
        margin-top: 10px;
    }
    .nav-link {
        color: white !important;
        border: none !important;
    }
    .wi {
        width: 100% !important;
    }
    .card p {
        font-size: 13px !important;
    }
    .card {
        width: 15rem;
    }
    .card-body {
        margin-left: 0px !important;
        text-align: center;
    }
}
</style>
