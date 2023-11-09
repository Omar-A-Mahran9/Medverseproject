<template>
    <section style="position: relative" class="mt-5">
        <div class="container-fluid">
            <div
                class="row align-items-center justify-content-center text-center text-md-start"
                style="margin-bottom: 200px"
            >
                <div class="col-12 col-lg-7 mb-5">
                    <div class="wi">
                        <h1>Welcome to Med-verse Cloud Inventory System</h1>
                        <p>
                            We provide cloud solution platform to help you
                            manage your dental clinic products stock with newest
                            technology to help you care and check all your
                            monthly expenditure for each clinic of the dental.
                        </p>
                        <a
                            href="#inventoryservices"
                            style="border-radius: 10px; width: 200px"
                            class="btn btn-primary mt-4 pt-2"
                        >
                            Grt started
                            <img class="ms-3" src="@/assets/image/arrow.svg" />
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <img src="@/assets/image/Inventoryimg.svg" width="100%" />
                </div>
            </div>
        </div>
        <div class="container-fluid" id="inventoryservices">
            <div class="row align-items-center justify-content-center">
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
            </div>
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
        return { imageUrl, services };
    },
};
</script>
<style scoped>
.swal2-container {
    z-index: 999999999999999 !important;
}
.wi {
    width: 80%;
}
.card {
    background-color: #d6efeb;
    border-radius: 20px;
    width: 22rem;
    text-align: justify;
    height: 471px;
}
@media screen and (max-width: 992px) {
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
