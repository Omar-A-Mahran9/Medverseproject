<template>
    <section class="pb-5">
        <div class="row align-items-start">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="mb-4">
                    <p class="text-capitalize seccolor title">
                        Med-Verse offers a
                        <span
                            style="
                                -webkit-text-fill-color: transparent;
                                text-stroke: 2px;
                                -webkit-text-stroke-width: 2px;
                            "
                            >Cloud Solution Platform</span
                        >
                        to help you mange your dental clinic products
                    </p>
                </div>
                <div>
                    <p class="parager" style="font-weight: lighter">
                        We know that keeping your hospital/ clinic running
                        smoothly is a full time job. That's why we have created
                        med-verse, an all in one inventory and point of sale
                        system designed to make your life easier.
                    </p>
                </div>
                <div class="bttn">
                    <a href="#ourservices" class="btn-primary homebtn"
                        >Get Started Now</a
                    >
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="backheader">
                    <div
                        class="row align-items-center cart"
                        style="
                            position: absolute;
                            bottom: 45px;
                            left: 55px;
                            background-color: white;
                            border-radius: 35px;
                        "
                    >
                        <div class="col-6">
                            <img src="@/assets/image/Group7.svg" width="100%" />
                        </div>
                        <div class="col-6">
                            <p>
                                <b><span>+1K</span> and more</b><br />
                                services and materials
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
.backheader {
    position: relative;
    bottom: 150px;
}
.homebtn {
    color: white;
    font-size: 13px;
    padding: 12px !important;
    border-radius: 20px;
}

.parager {
    width: 65%;
    margin: auto;
    text-align: justify;
}
.title {
    margin-top: 10% !important;
    width: 65%;
    font-size: 40px;
    font-weight: 700;
    margin: auto;
}
.bttn {
    width: 65%;
    margin: auto !important;
    margin-top: 30px !important;
}

.homebtn {
    color: white;
    font-size: 13px;
    padding: 12px !important;
    border-radius: 20px;
}

.parager {
    width: 65%;
    margin: auto;
    text-align: justify;
}
.title {
    width: 65%;
    font-size: 40px;
    font-weight: 700;
    margin: auto;
}
.bttn {
    width: 65%;
    margin: auto !important;
    margin-top: 30px !important;
}

@media only screen and (max-width: 768px) {
}

/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    .backheader {
        position: relative;
        top: 30px;
    }

    .parager {
        width: 95%;
        margin: auto;
        text-align: justify;
    }
    .title {
        margin-top: 30px !important;
        width: 95%;
        font-size: 20px;
        font-weight: 700;
        margin: auto;
        text-align: justify;
    }
    .bttn {
        width: 90%;
        margin: auto !important;
        margin-top: 30px !important;
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (max-width: 1200px) {
    .parager {
        width: 95%;
        margin: auto;
        text-align: justify;
    }
    .title {
        margin-top: 30px !important;
        width: 95%;
        font-size: 20px;
        font-weight: 700;
        margin: auto;
        text-align: justify;
    }
    .bttn {
        width: 90%;
        margin: auto !important;
        margin-top: 30px !important;
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (max-width: 992px) {
    .backheader {
        position: relative;
        top: 30px;
    }

    .cart {
        display: none !important;
    }
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
}
</style>
