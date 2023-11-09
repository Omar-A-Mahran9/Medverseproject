<template>
    <div
        v-if="reload"
        class="spinner-grow text-danger"
        style="margin-left: 50%; margin-top: 25%"
        role="status"
    >
        <!-- <span class="visually-hidden">Loading...</span> -->
    </div>
    <div v-if="!reload">
        <div class="content-header">
            <div class="container-fluid">
                <div
                    class="row mb-2"
                    v-if="
                        currentuser.role != 'ADMIN' &&
                        currentuser.role != 'SUPPLIER'
                    "
                >
                    <div class="col-sm-6">
                        <h1 class="m-0">Welcome To Med-Verse</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div
            v-if="currentuser.role != 'ADMIN' && currentuser.role != 'SUPPLIER'"
        >
            <div class="container-fluid pl-4 pr-4">
                <div class="wrapper">
                    <!-- Content Wrapper. Contains page content -->
                    <div class="mb-3 text-right">
                        <button
                            @click="addnewclinic"
                            class="btn btn-danger pl-4 pr-4"
                        >
                            Add New Clinic
                            <i class="ml-2 fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- <inventory :Allproduct="Allproduct" /> -->
                    <section class="content">
                        <div class="row">
                            <div
                                v-if="allclincs.length > 0"
                                v-for="clinic in allclincs"
                                :key="clinic.id"
                                class="col-lg-3 col-6 text-center"
                            >
                                <!-- small box -->
                                <div
                                    class="small-box bg-white"
                                    style="border: 2px solid #03a9f5"
                                >
                                    <div class="inner">
                                        <h3>
                                            <i
                                                class="fas fa-home"
                                                style="color: #03a9f5"
                                            ></i>
                                        </h3>

                                        <p>{{ clinic.clinicname }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <router-link
                                        :to="{
                                            name: 'admin.inventoryclinic',
                                            params: { clinic_id: clinic.id },
                                        }"
                                        class="small-box-footer text-left pl-3"
                                        style="background-color: #03a9f5"
                                    >
                                        More info
                                        <i
                                            class="fas fa-arrow-circle-right float-right pr-3 mt-1"
                                        ></i>
                                    </router-link>
                                </div>
                            </div>
                            <div v-else>
                                {{ notfond }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div id="addnewclinic" class="modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Clinic</h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="productname"
                                            >number of Clinic</label
                                        >
                                        <div class="quantity-toggle d-flex">
                                            <button
                                                class="btn btn-danger"
                                                @click.prevent="decrement"
                                            >
                                                &mdash;
                                            </button>
                                            <input
                                                class="bg-danger btn btn-danger"
                                                type="text"
                                                style="width: 50px"
                                                :value="quantity"
                                                readonly
                                            />
                                            <button
                                                class="btn btn-danger"
                                                @click.prevent="increment"
                                            >
                                                &#xff0b;
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-col">
                                    <div
                                        v-for="index in quantity"
                                        :key="index"
                                        class="form-group col-md-6"
                                    >
                                        <label for="productname"
                                            >Clinic name</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="productname"
                                            v-model="clinics[index - 1].name"
                                            placeholder="Enter product name"
                                        />
                                    </div>
                                    <!-- <span>{{ clinics[index - 1].name }}</span> -->
                                </div>

                                <div
                                    class="float-right d-flex align-items-center"
                                >
                                    <div class="pr-2">
                                        <h5 class="">Price</h5>
                                    </div>
                                    <div>
                                        <h4>{{ totalprice }} $</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer float-left">
                                <button
                                    type="button"
                                    @click="confirmbuumodal"
                                    class="btn btn-danger"
                                >
                                    Buy now
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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

                                                        <div
                                                            class="input-group"
                                                        >
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
                                                                        src="../../../../assets/image/visa.png"
                                                                        alt=""
                                                                        width="25"
                                                                    />
                                                                    <img
                                                                        src="../../../../assets/image/mada.svg"
                                                                        alt=""
                                                                        width="25"
                                                                    />
                                                                    <img
                                                                        src="../../../../assets/image/master.svg"
                                                                        alt=""
                                                                        width="25"
                                                                    />
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <div
                                                                class="form-group"
                                                            >
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
                                                                storeclinic()
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
                                                    Select your paypal account
                                                    type
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
                                                    button, you will be directed
                                                    to a secure gateway for
                                                    payment. After completing
                                                    the payment process, you
                                                    will be redirected back to
                                                    the website to view details
                                                    of your order.
                                                </p>
                                            </div>
                                            <!-- End -->
                                            <!-- bank transfer info -->
                                            <div
                                                id="net-banking"
                                                class="tab-pane fade pt-3"
                                            >
                                                <div class="form-group">
                                                    <label
                                                        for="Select Your Bank"
                                                    >
                                                        <h6>
                                                            Select your Bank
                                                        </h6>
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
                                                    button, you will be directed
                                                    to a secure gateway for
                                                    payment. After completing
                                                    the payment process, you
                                                    will be redirected back to
                                                    the website to view details
                                                    of your order.
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
        </div>
        <div v-else><h1 class="text-center">Welcome To Med-Verse</h1></div>
    </div>
</template>
<style scoped></style>
<script setup>
import axios from "axios";
import { reactive, ref, onBeforeMount, onMounted } from "vue";
import { usetoaster } from "../../../../toaster.js";
import inventory from "../../../Dashboard/content/inventory/Inventory.vue";
const components = {
    inventory,
};
const format = window.Laravel.format;
const toaster = usetoaster();
const allclincs = ref([]);
const allfilterclinic = ref([]);
const notfond = ref();
const price = ref(50);
const currentuser = window.Laravel.user;

const reload = ref(false);
const totalprice = ref();
var quantity = ref(1);
var clinics = ref([
    { name: "", price: price.value },
    { name: "", price: price.value },
    { name: "", price: price.value },
    { name: "", price: price.value },
    { name: "", price: price.value },
]);

const allclinces = () => {
    const user = window.Laravel.user;
    axios.get(`/api/clinics/${user.id}`).then((response) => {
        allclincs.value = response.data;

        if (response.data.length < 1) {
            notfond.value = "You do not have any clinic until yet";
        } else {
            allclincs.value = response.data;
        }
    });
};

const addnewclinic = () => {
    allfilterclinic.value = [];
    $("#addnewclinic").modal("show");
};
const confirmbuumodal = () => {
    clinics.value.forEach((element) => {
        if (element.name != "") {
            allfilterclinic.value.push(element);
        }
    });

    if (allfilterclinic.value.length === 0) {
        alert("You must fill at least one clinic");
    } else {
        $("#addnewclinic").modal("hide");
        $("#paymodal").modal("show");
    }
};

const storeclinic = () => {
    axios.post("/api/clinics", allfilterclinic.value).then((response) => {
        response.data.forEach((element) => {
            allclincs.value.unshift(element);
        });

        $("#paymodal").modal("hide");
        toaster.success("Successfuly clinics Added");
        quantity.value = 1;
        clinics.value = [
            { name: "", price: price.value },
            { name: "", price: price.value },
            { name: "", price: price.value },
            { name: "", price: price.value },
            { name: "", price: price.value },
        ];
    });
};
var increment = () => {
    if (quantity.value === 5) {
        alert("max 5 clinincs per once");
    } else {
        quantity.value++;
        totalprice.value += price.value;

        // clinics.value[quantity.value - 1].price = 50;
        // console.log(clinics.value);
    }
};
var decrement = () => {
    if (quantity.value === 1) {
        alert("min 1 clinincs ");
    } else {
        quantity.value--;
        totalprice.value -= price.value;
    }
};
const getsettings = () => {
    reload.value = true;
    axios.get("/api/settings").then((response) => {
        totalprice.value = parseInt(response.data.clincprice);
        price.value = parseInt(response.data.clincprice);
        reload.value = false;
    });
};

onBeforeMount(() => {
    getsettings();
    allclinces();
});
</script>
