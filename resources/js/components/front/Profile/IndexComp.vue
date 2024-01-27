<template>
    <Header></Header>
    <section class="container-fluid pb-5">
        <swiper
            :slides-per-view="1"
            :space-between="100"
            @swiper="onSwiper"
            @slideChange="onSlideChange"
            :navigation="{
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
                clickable: true,
            }"
            :autoplay="{
                delay: 2500,
                disableOnInteraction: false,
            }"
            :pagination="{
                dynamicBullets: true,
                clickable: true,
            }"
            :modules="modules"
            class="mySwiper"
        >
            <swiper-slide class="pb-5" v-for="(pack, i) in dat" :key="i">
                <div
                    class="row align-items-center justify-content-center mt-5 text-center text-md-start"
                >
                    <div class="col-12 col-md-6">
                        <h1 style="width: 90%" class="mb-5 h1">
                            {{ pack.description }}
                        </h1>
                    </div>
                    <div class="col-12 col-md-6">
                        <img :src="imageUrl + '/' + pack.image" class="ima" />
                    </div>
                </div>
            </swiper-slide>
            <div class="d-flex gap-5" style="margin: auto; width: 150px">
                <a
                    class="pe-5 ar swiper-button-prev"
                    style="filter: opacity(50%)"
                >
                    <img src="@/assets/image/leftarrow.svg" />
                </a>
                <a
                    style="filter: opacity(50%)"
                    class="ar ps-5 swiper-button-next swiper-button"
                >
                    <img src="@/assets/image/rightarrow.svg" />
                </a>
            </div>
        </swiper>
    </section>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import { useSwiper } from "swiper/vue";
import Header from "@/components/front/Profile/HeaderComp.vue";

import "swiper/css";
import "swiper/css/pagination";
// import "swiper/css/navigation";

import { Pagination, Navigation, Autoplay } from "swiper/modules";

export default {
    components: {
        Swiper,
        SwiperSlide,
        Header,
    },
    setup() {
        const swiper = useSwiper();

        return {
            modules: [Pagination, Navigation, Autoplay],
            swiper,
        };
    },

    data() {
        const imageUrl = new URL("../../../assets/image/", import.meta.url);

        return {
            imageUrl,

            dat: [
                {
                    description:
                        " Now With Med-Verce you can Mange your dental clinic & save more money in easiest way",
                    image: "profile.jpg",
                },
                {
                    description:
                        " Now With Med-Verce you can Mange your dental clinic & save more money in easiest way",
                    image: "profile.jpg",
                },
                {
                    description:
                        " Now With Med-Verce you can Mange your dental clinic & save more money in easiest way",
                    image: "profile.jpg",
                },
            ],
        };
    },
};
</script>
<style scoped>
.ar:hover {
    filter: opacity(100%) !important;
}
.ima {
    width: 100%;
}

@media screen and (max-width: 992px) {
    .h1 {
        font-size: 18px !important;
        width: 100% !important;
    }
}
</style>
