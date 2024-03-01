<template>
    <section id="ourstory" class="section mt-5 pb-5">
        <div class="container-fluid">
            <div
                class="row justify-content-center justify-content-lg-between align-items-center"
            >
                <div class="col-12 col-md-6 co1">
                    <div class="sectitle mb-5">
                        <div
                            class="d-flex align-items-center gap-2"
                            style="color: #f59e0b"
                        >
                            <div
                                style="
                                    border-bottom: 2px solid #f59e0b;
                                    width: 30px;
                                "
                            ></div>
                            Our Story
                        </div>
                        <div style="margin-left: 35px"><h4>Our Story</h4></div>
                        <p class="pb-2" style="text-align: justify">
                            Born from the shared vision of Prof. Yaser Alkhiary
                            and Dr. Muhannad Shuman, Med-Verse is a testament to
                            innovation in healthcare. Inspired by their
                            experiences in clinic management, they created a
                            platform to streamline operations and enhance
                            efficiency. Med-Verse offers diverse services
                            including consultancy, clinic design & construction,
                            and inventory management. A unique addition is our
                            academy section for healthcare-related events. The
                            essence of Med-Verse lies in the balance between
                            Prof. Alkhiary's wisdom and Dr. Shuman's ambition.
                            Their collaboration has replaced traditional
                            clinical management challenges with a unified,
                            efficient solution. Welcome to Med-Verse - merging
                            wisdom, ambition, and innovation to the healthcare
                            sectors.
                        </p>
                    </div>

                    <hr class="mt-5" />
                    <div
                        class="d-flex flex-column gap- mb-3 flex-md-row justify-content-between align-items-center"
                    >
                        <div class="d-flex align-items-center gap-4">
                            <div class="mb-3">
                                <img
                                    src="@/assets/image/talal.jpg"
                                    width="60px"
                                    height="60px"
                                    style="
                                        border-radius: 50%;
                                        object-fit: cover;
                                        object-position: center center;
                                    "
                                />
                            </div>
                            <div style="line-height: 20px">
                                <p class="fw-bold">
                                    Dr. Muhannad Talal Shouman
                                </p>
                                <p style="color: #888b97; font-weight: 400">
                                    Manager Director
                                </p>
                            </div>
                        </div>
                        <div>
                            <a
                                class="btn btn-primary pt-2 d-flex justify-content-center"
                                href="tel:+966 50 535 8306"
                                style="width: 150px"
                            >
                                <img src="@/assets/image/call.svg" />
                                contact Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 image-container">
                    <div class="d-flex gap-2">
                        <img
                            src="@/assets/image/talal.jpg"
                            alt="Image 1"
                            width="50%"
                            style="
                                border-radius: 20px;
                                object-fit: cover;
                                object-position: center center;
                            "
                        />
                        <img
                            src="@/assets/image/yaseser.jpg"
                            alt="Image 2"
                            width="50%"
                            style="
                                border-radius: 20px;
                                object-fit: cover;
                                object-position: center center;
                            "
                        />
                    </div>

                    <!-- <div style="position: relative">
                        <video
                            ref="video"
                            style="width: 100% !important"
                            poster="@/assets/image/Ourstory.jpg"
                        >
                            <source src="" type="video/mp4" />
                            <source src="@/assets/video/cover.mp4" type="video/ogg" /> 
                            Your browser does not support the video tag.
                        </video>
                       <div>
              <a
                v-if="isPlaying == false"
                @click="playVideo"
                style="position: absolute; top: 45%; left: 46%"
                ><img
                  src="@/assets/image/play.svg"
                  style="z-index: 99; cursor: pointer !important"
              /></a>
              <a
                v-if="isPlaying == true"
                @click="pauseVideo"
                style="position: absolute; top: 45%; left: 46%"
                ><img
                  src="@/assets/image/puse.png"
                  style="z-index: 99; cursor: pointer !important"
              /></a>
            </div>
                        <div
                            style="position: absolute; bottom: -40px"
                            class="p-4 row align-items-end"
                        >
                            <img
                                class="col-6"
                                src="@/assets/image/Inventory.jpeg"
                            />
                            <img
                                class="col-3"
                                src="@/assets/image/Consultant.jpeg"
                            />
                            <img
                                class="col-3"
                                src="@/assets/image/Education.jpeg"
                            />
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        return {
            isPlaying: false,
        };
    },
    methods: {
        playVideo() {
            this.isPlaying = true;
            this.$refs.video.play();
        },
        pauseVideo() {
            this.isPlaying = false;
            this.$refs.video.pause();
        },
    },
};
</script>
<style scoped>
a {
    cursor: pointer !important;
}

.co1 {
    width: 34%;
}
@media screen and (max-width: 992px) {
    .co1 {
        width: 80% !important;
        text-align: center;
    }
}
@media screen and (max-width: 500px) {
    .co1 {
        width: 100% !important;
    }
}
</style>
