<template>
    <div class="back mb-5">
        <div class="video-background">
            <video autoplay muted loop>
                <source
                    src="../../../assets/image/Med-Verse.mp4"
                    type="video/mp4"
                />
                Your browser does not support the video tag.
            </video>
        </div>
        <headercomp />
        <sectionone />
    </div>
    <sectiontwo />
    <sectionthree />
    <sectionfour />
    <sectionfive />
    <!-- <sectionsix /> -->
    <footercomp />
</template>
<script>
import headercomp from "@/components/front/home/layout/HeaderView.vue";
import sectionone from "@/components/front/home/SectionOne.vue";
import sectiontwo from "@/components/front/home/SectionTwo.vue";
import sectionthree from "@/components/front/home/SectionThree.vue";
import sectionfour from "@/components/front/home/SectionFour.vue";
import sectionfive from "@/components/front/home/SectionFive.vue";
import sectionsix from "@/components/front/home/SectionSix.vue";

import footercomp from "@/components/front/home/layout/FooterView.vue";
export default {
    components: {
        headercomp,
        sectionone,
        sectiontwo,
        sectionthree,
        sectionfour,
        sectionfive,
        sectionsix,
        footercomp,
    },
};
</script>
<style scoped>
.back {
    position: relative;
}

.video-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.video-background video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.video-background::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 0.2; /* Adjust the opacity as needed */
}
</style>
