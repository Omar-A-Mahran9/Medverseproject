<template>
    <div class="back mb-5">
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
    background-image: url("../../../assets/image/image6.jpg");
    background-attachment: fixed;
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
