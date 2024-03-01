<template>
    <section class="container-fluid back" style="width: 100%">
        <div class="container-fluid contain">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-6 respo">
                    <!-- <div>
                        <img
                            src="@/assets/image/login.jpeg"
                            class="cover"
                        />
                    </div> -->
                </div>
                <div class="col-12 col-md-12 login-container">
                    <div class="blur-background">
                        <div class="form-container">
                            <div
                                class="d-flex flex-column align-items-center gap-4"
                            >
                                <a class="navbar-brand" href="/">
                                    <img
                                        src="@/assets/image/Logo.svg"
                                        width="200"
                                        class="white-fill"
                                    />
                                </a>
                                <h3 style="margin-bottom: 50px !important">
                                    Login to your account
                                </h3>
                            </div>

                            <p
                                class="text-danger text-center"
                                v-text="errors.global"
                            ></p>

                            <div
                                v-if="cardentialerror"
                                class="alert alert-danger text-center"
                                role="alert"
                            >
                                {{ cardentialerror }}
                            </div>
                            <form class="form" @submit.prevent="Login()">
                                <div class="row mb-5">
                                    <div
                                        class="col-sm-10 d-flex align-items-center"
                                    >
                                        <img
                                            src="@/assets/image/Iconsax/Linear/profilecircle.svg"
                                        />

                                        <input
                                            style="background: transparent"
                                            type="email"
                                            name="email"
                                            v-model="login.email"
                                            class="form-control"
                                            id="inputEmail3"
                                            placeholder="Enter Your Email"
                                        />
                                    </div>
                                    <div v-if="errors.email.length > 0">
                                        <p
                                            class="text-danger"
                                            v-text="errors.email"
                                        ></p>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div
                                        class="col-sm-10 d-flex align-items-center"
                                    >
                                        <img
                                            src="@/assets/image/Iconsax/Linear/lock1.svg"
                                        />
                                        <input
                                            style="background: transparent"
                                            type="password"
                                            v-model="login.password"
                                            name="password"
                                            class="form-control"
                                            id="inputPassword3"
                                            placeholder="Enter Your Password"
                                        />
                                    </div>
                                    <div v-if="errors.password.length > 0">
                                        <p
                                            class="text-danger"
                                            v-text="errors.password"
                                        ></p>
                                    </div>
                                </div>
                                <!-- <a style="cursor: pointer">
                                    <div class="mb-5 text-end">
                                        Forgot Password ?
                                    </div></a
                                > -->
                                <button
                                    type="submit"
                                    class="btn btn-primary form-control"
                                >
                                    Sign in
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="resg d-flex justify-content-center">
                        Don’t have an account ?
                        <router-link
                            :to="{ name: 'Signup' }"
                            class="fw-bold"
                            style="text-decoration: none; color: black"
                            >Register Now
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
.form-container {
    position: relative;
    width: 100%;
    max-width: 600px; /* Adjust the max-width as needed */
    margin: auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.8); /* Adjust the background opacity */
    border-radius: 15px; /* Adjust the radius */

    /* Add the following styles for the blurred background */
    overflow: hidden;
}
.swal2-container {
    z-index: 99999999 !important;
}
.back {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("@/assets/image/login.jpg") center center no-repeat;
    background-size: cover;
}

.cover {
    width: 79%;
}
.txt {
    width: 100% !important;
    padding-bottom: 50px !important;
}
.form {
    width: 80%;
    margin: auto;
}
input {
    margin-left: 15px;
    padding: 0px;
    padding-bottom: 13px;
    border: none;
    border-radius: 0px;
    border-bottom: 2px solid rgb(174, 174, 174);
}
.btn-primary {
    background-color: #65c5b9;
    border-radius: 0;
}
.contain {
    margin-top: 10%;
}
@media only screen and (max-width: 992px) {
    .respo {
        display: flex;
        flex-direction: column;
        justify-content: center !important;
        align-items: center !important;
        margin-bottom: 70px;
    }
    .txt {
        width: 100% !important;
    }
    .cover {
        width: 100%;
    }

    .container-fluid {
        width: 100%;
    }
}

/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    .form {
        width: 100%;
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (max-width: 1200px) {
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
}
</style>
<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    name: "loginPage",

    data() {
        const cardentialerror = null;
        return {
            cardentialerror,
            login: { email: "", password: "" },
            errors: {
                email: [],
                password: [],
                global: "",
            },
        };
    },
    methods: {
        async Login() {
            await axios
                .post("/login", this.login)
                .then((response) => {
                    window.location.href = "/profile";
                })
                .catch((errors) => {
                    this.cardentialerror = errors.response.data.message;
                });
        },
    },
};
</script>
