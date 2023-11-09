<template>
    <section class="container-fluid back" style="width;: 100%px">
        <div class="container-fluid contain">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-6 respo">
                    <div>
                        <h1 class="txt">Welcome back!</h1>
                    </div>
                    <div>
                        <img
                            src="@/assets/image/RectangleLogin.svg"
                            class="cover"
                        />
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <h3
                        style="margin-bottom: 100px !important"
                        class="mb-5 text-center"
                    >
                        Login to your account
                    </h3>
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
                            <div class="col-sm-10 d-flex align-items-center">
                                <img
                                    src="@/assets/image/Iconsax/Linear/profilecircle.svg"
                                />

                                <input
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
                            <div class="col-sm-10 d-flex align-items-center">
                                <img
                                    src="@/assets/image/Iconsax/Linear/lock1.svg"
                                />
                                <input
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
                        <a style="cursor: pointer">
                            <div class="mb-5 text-end">
                                Forgot Password ?
                            </div></a
                        >
                        <button
                            type="submit"
                            class="btn btn-primary form-control"
                        >
                            Sign in
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="resg">
            Don’t have an account ?
            <router-link
                :to="{ name: 'Signup' }"
                class="fw-bold"
                style="text-decoration: none; color: black"
                >Register Now
            </router-link>
        </div>
    </section>
</template>
<style scoped>
.swal2-container {
    z-index: 99999999 !important;
}
.resg {
    position: absolute;
    bottom: -70px;
    right: 100px;
}
.cover {
    width: 79%;
}
.txt {
    width: 30% !important;
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
.back {
    width: 100%;
    position: absolute;
    background: url("@/assets/image/Vectorlogin.svg");
    background-repeat: no-repeat;
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
    .resg {
        position: relative;
        text-align: center !important;
        width: 100%;
        bottom: -6px;
        right: 0px;
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
