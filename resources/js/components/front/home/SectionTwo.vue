<template>
    <section id="ourservices" class="section pb-5" style="overflow: hidden">
        <div
            class="container-fluid d-flex flex-column align-items-center mb-3 justify-content-center"
        >
            <p class="text-center" style="color: #f59e0b">
                See O<span
                    style="border-top: 2px solid #f59e0b; padding-top: 8px"
                    >ur Se</span
                >rvices
            </p>
            <h3 class="text-center">Explore our cloud Solutions</h3>
        </div>
        <div class="row gap-5">
            <swiper
                :slidesPerView="1"
                :pagination="{
                    clickable: true,
                }"
                :breakpoints="{
                    '640': {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    '900': {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                    '1200': {
                        slidesPerView: 3,
                        spaceBetween: 50,
                    },
                }"
                :modules="modules"
                class="mySwiper"
            >
                <swiper-slide v-for="service in services" :key="service.title">
                    <div
                        style="height: 355px !important"
                        class="cardimage col-4 mb-5"
                    >
                        <div class="card-body">
                            <div style="margin: 40px">
                                <h4>{{ service.title }}</h4>
                                <p style="font-weight: lighter">
                                    {{ service.description }}
                                </p>
                                <a
                                    :href="'/' + service.router"
                                    class="btn btn-primary float-right"
                                    style="
                                        position: absolute;
                                        height: 20% !important;
                                        margin-right: 30px;
                                        right: 0 !important;
                                    "
                                >
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </swiper-slide>
            </swiper>
        </div>
    </section>
</template>
<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Pagination } from "swiper/modules";
// Import Swiper styles
import "swiper/css";

import "swiper/css/pagination";
export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Pagination],
        };
    },
    data() {
        return {
            services: [
                {
                    title: "Inventory System",
                    description: "service brief",
                    router: "inventory",
                },
                {
                    title: "Consultant services",
                    description: "service brief",
                    router: "consultant",
                },
                {
                    title: "Academic services",
                    description: "service brief",
                    router: "academic",
                },
            ],
        };
    },
};
</script>
<style scoped>
.swiper {
    overflow: unset !important;
}
.cardimage {
    background: url("@/assets/image/Rectangle21.svg");
    background-repeat: no-repeat;
    background-size: cover;
    margin: auto;
    border-radius: 20px;
    width: 100%;
    height: 355px;
    position: relative;
}
.card-body {
    background-color: white;
    border-radius: 20px;
    width: 80%;
    height: 199px;
    position: absolute;
    bottom: -100px;
    margin-left: 40px;
}
.swiper {
    height: 480px;
}

@media only screen and (max-width: 768px) {
    .cardimage {
        background: url("@/assets/image/Rectangle21.svg");
        background-repeat: no-repeat;
        background-size: cover;
        margin: auto;
        border-radius: 20px;
        width: 90%;
        height: 355px;
        position: relative;
    }
    .card-body {
        background-color: white;
        border-radius: 20px;
        width: 80%;
        height: 199px;
        position: absolute;
        bottom: -100px;
        margin-left: 20px;
    }
}

/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (max-width: 1400px) {
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 600px) and (max-width: 1250px) {
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 1250px) {
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1400px) and (max-width: 1600px) {
}
</style>
