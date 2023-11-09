<template>
  <section id="ourstory" class="section mt-5 pb-5">
    <div class="container-fluid">
      <div
        class="row justify-content-center justify-content-lg-between align-items-center"
      >
        <div class="col-12 col-md-6 co1">
          <div class="sectitle mb-5">
            <div class="d-flex align-items-center gap-2" style="color: #f59e0b">
              <div style="border-bottom: 2px solid #f59e0b; width: 30px"></div>
              Our Recommendation
            </div>
            <div style="margin-left: 35px"><h4>Our Story</h4></div>
            <p class="pb-2">
              Houses recommended by our partners that have been curated to
              become the home of your dreams!
            </p>
          </div>

          <hr class="mt-5" />
          <div
            class="d-flex flex-column gap- mb-3 flex-md-row justify-content-between align-items-center"
          >
            <div class="d-flex align-items-center gap-4">
              <div class="mb-3">
                <img src="@/assets/image/Ellipse.svg" width="100%" />
              </div>
              <div style="line-height: 15px">
                <p class="fw-bold">Mohannad</p>
                <p style="color: #888b97; font-weight: 400">Manager Director</p>
              </div>
            </div>
            <div>
              <a class="btn btn-primary pt-2" href="#footer">
                <img src="@/assets/image/call.svg" /> contact Now
              </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div style="position: relative">
            <video
              ref="video"
              style="width: 100% !important"
              poster="@/assets/image/poster.svg"
            >
              <source src="" type="video/mp4" />
              <!-- <source src="@/assets/video/cover.mp4" type="video/ogg" /> -->
              Your browser does not support the video tag.
            </video>
            <!-- <div>
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
            </div> -->
            <div
              style="position: absolute; bottom: -40px"
              class="p-4 row align-items-end"
            >
              <img class="col-6" src="@/assets/image/Rectangle18.svg" />
              <img class="col-3" src="@/assets/image/Rectangle18.svg" />
              <img class="col-3" src="@/assets/image/Rectangle18.svg" />
            </div>
          </div>
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
