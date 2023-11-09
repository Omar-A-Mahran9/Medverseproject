<template>
    <section style="background-color: #65c5b933">
        <div class="container-fluid pt-5 mt-5">
            <h5 class="mb-4 text-muted">Our Partnership</h5>
            <div
                class="row align-items-center justify-content-center text-center"
            >
                <div
                    class="col-12 col-md-2 mb-5"
                    v-for="(logo, i) in logos"
                    :key="i"
                >
                    <img :src="imageUrl + '/' + logo" width="100" />
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    data() {
        const imageUrl = new URL("../../../assets/image/", import.meta.url);

        return {
            imageUrl,
            logos: [
                "logo1.svg",
                "logo2.svg",
                "logo3.svg",
                "logo1.svg",
                "logo2.svg",
                "logo3.svg",
            ],
        };
    },
};
</script>
