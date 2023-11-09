<template>
    <section class="">
        <div class="sectitle mb-5">
            <div class="d-flex align-items-center gap-2" style="color: #f59e0b">
                <div
                    style="border-bottom: 2px solid #f59e0b; width: 30px"
                ></div>
                Our Recommendation
            </div>
            <div style="margin-left: 35px"><h4>Our Subscription Plans</h4></div>
        </div>
        <h1 class="text-center mb-4">Choose Yor Plan</h1>
        <div
            class="p-1 row justify-content-center align-items-center text-center mb-5 plan"
            style="
                background-color: #d3e7f0;
                color: #034f75 !important;
                border-radius: 7px;

                margin: auto;
            "
        >
            <a
                @click.prevent="individual"
                href=""
                :class="indactive"
                class="p-2 col-6"
                style="
                    border-radius: 7px;
                    font-size: 100%;
                    color: #1d617a;
                    text-decoration: none;
                "
            >
                Individuals
            </a>
            <a
                @click.prevent="clinics"
                :class="cliactive"
                class="p-2 col-6"
                style="
                    border-radius: 7px;
                    font-size: 100%;
                    color: #1d617a;
                    text-decoration: none;
                "
                href=""
            >
                Clinics
            </a>
        </div>
        <div class="row justify-content-center align-items-center">
            <div
                v-for="value in packages"
                :key="value.id"
                class="col-sm-6 col-md-4"
                style="width: 362px"
            >
                <div class="card mb-4 text-center coll">
                    <div class="card-body">
                        <h5 class="card-title mb-3">
                            {{ value.package_name }}
                        </h5>
                        <h1>{{ value.price }} <span>SAR</span></h1>
                        <p>User/Month</p>
                        <ul class="list-group">
                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['Cloud inventory system'] == 1"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti"
                                        >Cloud inventory system</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value['One clinic (you can add more)'] == 1
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti"
                                        >One clinic (you can add more)</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['E-store'] == 1"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti">E-store</span>
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['Reports'] == 1"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti">Reports</span>
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['Analysis'] == 1"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti">Analysis</span>
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value[
                                        'Online Consultation (one session)'
                                    ] == 1
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti"
                                        >Online Consultation (one session)</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value[
                                        'One to one Consultation per session'
                                    ] == 1
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti"
                                        >One to one Consultation per
                                        session</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value['4 clinics (you can add more)'] == 1
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti"
                                        >4 clinics (you can add more)</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['Edit account'] == 1"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/trueicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti">Edit account</span>
                                </li>
                            </div>
                            <!--------------------------------------------------->
                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['Cloud inventory system'] == 0"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not"
                                        >Cloud inventory system</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value['One clinic (you can add more)'] == 0
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not"
                                        >One clinic (you can add more)</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['E-store'] == 0"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not">E-store</span>
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['E-store'] == 0"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not">E-store</span>
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['Analysis'] == 0"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not">Analysis</span>
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value[
                                        'Online Consultation (one session)'
                                    ] == 0
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not"
                                        >Online Consultation (one session)</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value['4 clinics (you can add more)'] == 0
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not"
                                        >4 clinics (you can add more)</span
                                    >
                                </li>
                            </div>

                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="value['Edit account'] == 0"
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="not">Edit account</span>
                                </li>
                            </div>
                            <div
                                class="d-flex"
                                style="width: 100%"
                                v-if="
                                    value[
                                        'One to one Consultation per session'
                                    ] == 0
                                "
                            >
                                <li
                                    class="list-group-item text-left"
                                    style="border: 0px; padding: 0px"
                                >
                                    <img
                                        src="@/assets/image/falseicon.svg"
                                        class="me-2"
                                    />
                                    <span class="acti"
                                        >One to one Consultation per
                                        session</span
                                    >
                                </li>
                            </div>
                        </ul>
                        <div
                            class="card-footer mt-3"
                            style="background-color: #fff; border: none"
                        >
                            <a @click.prevent="paypackage(value)" class="byn"
                                >Choose Plan</a
                            >
                        </div>
                    </div>
                </div>
            </div>

            <!------------------->
        </div>

        <div id="paymodal" class="modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Methods</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <div class="">
                                <div class="card-header">
                                    <div
                                        class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2"
                                    >
                                        <!-- Credit card form tabs -->
                                        <ul
                                            role="tablist"
                                            class="nav bg-light nav-pills rounded nav-fill mb-3"
                                        >
                                            <li class="nav-item">
                                                <a
                                                    data-toggle="pill"
                                                    href="#credit-card"
                                                    class="nav-link active"
                                                >
                                                    <i
                                                        class="fas fa-credit-card mr-2"
                                                    ></i>
                                                    Credit Card
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    data-toggle="pill"
                                                    href="#paypal"
                                                    class="nav-link"
                                                >
                                                    <i
                                                        class="fab fa-paypal mr-2"
                                                    ></i>
                                                    Paypal
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a
                                                    data-toggle="pill"
                                                    href="#net-banking"
                                                    class="nav-link"
                                                >
                                                    <i
                                                        class="fas fa-mobile-alt mr-2"
                                                    ></i>
                                                    Net Banking
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- End -->
                                    <!-- Credit card form content -->
                                    <div class="tab-content">
                                        <!-- credit card info-->
                                        <div
                                            id="credit-card"
                                            class="tab-pane fade show active pt-3"
                                        >
                                            <form role="form">
                                                <div class="form-group">
                                                    <label for="username">
                                                        <h6>Card Owner</h6>
                                                    </label>
                                                    <input
                                                        type="text"
                                                        name="username"
                                                        placeholder="Card Owner Name"
                                                        required
                                                        class="form-control"
                                                    />
                                                </div>
                                                <div class="form-group">
                                                    <label for="cardNumber">
                                                        <h6>Card number</h6>
                                                    </label>

                                                    <div class="input-group">
                                                        <input
                                                            type="text"
                                                            name="cardNumber"
                                                            placeholder="Valid card number"
                                                            class="form-control"
                                                            required
                                                        />
                                                        <div
                                                            class="input-group-append"
                                                        >
                                                            <span
                                                                class="input-group-text"
                                                            >
                                                                <img
                                                                    src="../../../assets/image/visa.png"
                                                                    alt=""
                                                                    width="25"
                                                                />
                                                                <img
                                                                    src="../../../assets/image/mada.svg"
                                                                    alt=""
                                                                    width="25"
                                                                />
                                                                <img
                                                                    src="../../../assets/image/master.svg"
                                                                    alt=""
                                                                    width="25"
                                                                />
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label>
                                                                <span
                                                                    class="hidden-xs"
                                                                >
                                                                    <h6>
                                                                        Expiration
                                                                        Date
                                                                    </h6>
                                                                </span>
                                                            </label>
                                                            <div
                                                                class="input-group"
                                                            >
                                                                <input
                                                                    type="number"
                                                                    placeholder="MM"
                                                                    name=""
                                                                    class="form-control"
                                                                    required
                                                                />
                                                                <input
                                                                    type="number"
                                                                    placeholder="YY"
                                                                    name=""
                                                                    class="form-control"
                                                                    required
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div
                                                            class="form-group mb-4"
                                                        >
                                                            <label
                                                                data-toggle="tooltip"
                                                                title="Three digit CV code on the back of your card"
                                                            >
                                                                <h6>
                                                                    CVV
                                                                    <i
                                                                        class="fa fa-question-circle d-inline"
                                                                    ></i>
                                                                </h6>
                                                            </label>
                                                            <input
                                                                type="text"
                                                                required
                                                                class="form-control"
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button
                                                        @click="
                                                            storePackageforuser()
                                                        "
                                                        type="button"
                                                        class="subscribe btn btn-danger btn-block shadow-sm"
                                                    >
                                                        Confirm Payment
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- End -->
                                        <!-- Paypal info -->
                                        <div
                                            id="paypal"
                                            class="tab-pane fade pt-3"
                                        >
                                            <h6 class="pb-2">
                                                Select your paypal account type
                                            </h6>
                                            <div class="form-group">
                                                <label class="radio-inline">
                                                    <input
                                                        type="radio"
                                                        name="optradio"
                                                        checked
                                                    />
                                                    Domestic
                                                </label>
                                                <label class="radio-inline">
                                                    <input
                                                        type="radio"
                                                        name="optradio"
                                                        class="ml-5"
                                                    />International
                                                </label>
                                            </div>
                                            <p>
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                >
                                                    <i
                                                        class="fab fa-paypal mr-2"
                                                    ></i>
                                                    Log into my Paypal
                                                </button>
                                            </p>
                                            <p class="text-muted">
                                                Note: After clicking on the
                                                button, you will be directed to
                                                a secure gateway for payment.
                                                After completing the payment
                                                process, you will be redirected
                                                back to the website to view
                                                details of your order.
                                            </p>
                                        </div>
                                        <!-- End -->
                                        <!-- bank transfer info -->
                                        <div
                                            id="net-banking"
                                            class="tab-pane fade pt-3"
                                        >
                                            <div class="form-group">
                                                <label for="Select Your Bank">
                                                    <h6>Select your Bank</h6>
                                                </label>
                                                <select
                                                    class="form-control"
                                                    id="ccmonth"
                                                >
                                                    <option
                                                        value=""
                                                        selected
                                                        disabled
                                                    >
                                                        --Please select your
                                                        Bank--
                                                    </option>
                                                    <option>Bank 1</option>
                                                    <option>Bank 2</option>
                                                    <option>Bank 3</option>
                                                    <option>Bank 4</option>
                                                    <option>Bank 5</option>
                                                    <option>Bank 6</option>
                                                    <option>Bank 7</option>
                                                    <option>Bank 8</option>
                                                    <option>Bank 9</option>
                                                    <option>Bank 10</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <p>
                                                    <button
                                                        type="button"
                                                        class="btn btn-primary"
                                                    >
                                                        <i
                                                            class="fas fa-mobile-alt mr-2"
                                                        ></i>
                                                        Proceed Payment
                                                    </button>
                                                </p>
                                            </div>
                                            <p class="text-muted">
                                                Note: After clicking on the
                                                button, you will be directed to
                                                a secure gateway for payment.
                                                After completing the payment
                                                process, you will be redirected
                                                back to the website to view
                                                details of your order.
                                            </p>
                                        </div>
                                        <!-- End -->
                                        <!-- End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";
const currentuser = window.Laravel.user;
import { usetoaster } from "../../../toaster.js";
const toaster = usetoaster();

const features = ref({});
var individuals = ref(true);
var indactive = ref("active");
var cliactive = ref("");

const individual = () => {
    individuals.value = true;
    getpackages();
    indactive.value = "active";
    cliactive.value = "";
};

const clinics = () => {
    individuals.value = false;
    getpackages();
    indactive.value = "";
    cliactive.value = "active";
};
const packages = ref([]);
const getpackages = () => {
    if (individuals.value == true) {
        axios.get("/packages/individual").then((respnse) => {
            packages.value = respnse.data;
        });
    } else {
        axios.get("/packages/clinic").then((respnse) => {
            packages.value = respnse.data;
        });
    }
};

const Packagedetails = ref(null);
const paypackage = (packag) => {
    if (currentuser && currentuser.role != "ADMIN") {
        Packagedetails.value = packag;
        $("#paymodal").modal("show");
    } else {
        toaster.error("Sorry Must be Login Firstly to choose Your Package");
    }
};
const storePackageforuser = () => {
    axios
        .post("/api/paypackage", {
            packag: Packagedetails.value,
            user: currentuser,
        })
        .then((response) => {
            if (response.data.error) {
                toaster.error(response.data.error);
            } else {
                toaster.success(response.data.message);
                $("#paymodal").modal("hide");
            }
        });
};

onMounted(() => {
    getpackages();
});
</script>
<style scoped>
.coll {
    cursor: pointer;
    background-color: #ffffff !important;
}
.active {
    background-color: #ffffff;
}
.coll:hover {
    .not,
    h1,
    p,
    .card-title,
    .acti {
        color: #ffffff !important;
    }
}

.coll:hover {
    background-color: #1d617a !important;
    scale: 105%;
}
.coll:hover .byn {
    color: #1d617a;
    background-color: #ffffff;
}

.byn {
    margin-top: 100px;
    color: #1d617a;
    background-color: #d3e7f0;
    padding: 10px;
    text-decoration: none;
    border-radius: 10px;
    padding-left: 35px;
    padding-right: 35px;
}
h1,
p {
    color: #1d617a !important;
}
.card-title {
    border: 1px solid;
    border-radius: 7px;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 70%;
    margin: auto;
}
h5 {
    color: #1d617a !important;
}
.acti {
    font-weight: normal;
    color: #1d617a;
    font-size: 80%;
}
.not {
    font-weight: lighter;
    color: #1d617a;
    font-size: 80%;
    text-decoration-line: line-through;
}
li {
    background-color: transparent !important;
}
.card-footer {
    background-color: transparent !important;
}
.plan {
    width: 23%;
}
@media screen and (max-width: 992px) {
    .plan {
        width: 100%;
    }
}
</style>
