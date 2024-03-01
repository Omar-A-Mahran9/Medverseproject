<template>
    <section id="aboutus" class="section pb-5" style="overflow: hidden">
        <div
            class="container-fluid d-flex flex-column align-items-center mb-3 justify-content-center"
        >
            <p class="text-center" style="color: #f59e0b">
                See w<span
                    style="border-top: 2px solid #f59e0b; padding-top: 8px"
                    >hat we are</span
                >
            </p>
            <h3 class="text-center">About Us</h3>
        </div>
        <div class="gap-5 container text-center" style="width: 70%;">
            <h5 style="font-weight: normal; line-height: 40px">
                At Med-Verse, we're revolutionizing healthcare services by
                leveraging the power of cloud technology. Our mission is to
                streamline operations and enhance efficiency in clinics,
                enabling them to focus on what truly matters - providing
                exceptional operation management
            </h5>
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
                    image: import("@/assets/image/Inventory.jpeg"),
                },
                {
                    title: "Consultation Services",
                    description: "service brief",
                    router: "consultant",
                    image: import("@/assets/image/consultant.jpeg"),
                },
                {
                    title: "Academy",
                    description: "service brief",
                    router: "academic",
                    image: import("@/assets/image/Education.jpeg"),
                },
            ],
        };
    },
    created() {
        // Load images asynchronously
        this.services.forEach((service) => {
            if (service.image) {
                service.image.then((module) => {
                    service.image = module.default;
                });
            }
        });
    },
};
</script>
<style scoped>
.swiper {
    overflow: unset !important;
}
.cardimage {
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
