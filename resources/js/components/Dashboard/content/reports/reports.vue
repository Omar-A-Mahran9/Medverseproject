<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="wrapper">
                    <div
                        class="bg-white mb-5"
                        style="border-radius: 25px; padding: 15px"
                    >
                        <div>
                            <form ref="form">
                                <div
                                    class="form-row align-items-center justify-content-center"
                                >
                                    <div class="form-group mr-3">
                                        <select
                                            name="myrequest"
                                            v-model="filter.request"
                                            style="
                                                padding: 10px;
                                                border-radius: 20px;
                                                font-size: 20px;
                                            "
                                        >
                                            <option hidden value="">
                                                Choose Request
                                            </option>
                                            <option
                                                v-for="request in allrequest"
                                                :key="request.id"
                                                :value="request.id"
                                            >
                                                {{ request.productname }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-3">
                                        <select
                                            name="myrequest"
                                            v-model="filter.group"
                                            style="
                                                padding: 10px;
                                                border-radius: 20px;
                                                font-size: 20px;
                                            "
                                        >
                                            <option hidden value="">
                                                Choose group
                                            </option>
                                            <option
                                                v-for="group in allgroup"
                                                :key="group.id"
                                                :value="group.id"
                                            >
                                                {{ group.Groupname }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-3">
                                        <select
                                            name="myrequest"
                                            v-model="filter.month"
                                            style="
                                                padding: 10px;
                                                border-radius: 20px;
                                                font-size: 20px;
                                            "
                                        >
                                            <option hidden value="">
                                                Choose Month
                                            </option>
                                            <option value="">Month</option>
                                            <option value="01">Jan</option>
                                            <option value="02">Feb</option>
                                            <option value="03">Mar</option>
                                            <option value="04">Apr</option>
                                            <option value="05">May</option>
                                            <option value="06">Jun</option>
                                            <option value="07">Jul</option>
                                            <option value="08">Aug</option>
                                            <option value="09">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-3">
                                        <select
                                            name="myrequest"
                                            v-model="filter.year"
                                            style="
                                                padding: 10px;
                                                border-radius: 20px;
                                                font-size: 20px;
                                            "
                                        >
                                            <option hidden value="">
                                                Choose year
                                            </option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                        </select>
                                    </div>
                                    <div class="ml-3">
                                        <!-- v-if="!loading" -->

                                        <button
                                            @click.prevent="submitform"
                                            type="submit"
                                            class="btn btn-danger pr-5 pl-5 mb-3"
                                            style="
                                                border-radius: 20px;
                                                padding: 10px;
                                            "
                                        >
                                            Generate Report
                                        </button>
                                        <button
                                            class="btn btn-danger pr-5 pl-5 mb-3"
                                            style="
                                                border-radius: 20px;
                                                padding: 10px;
                                                margin-left: 10px;
                                            "
                                            @click.prevent="
                                                submitform2((analysis = true))
                                            "
                                        >
                                            Analysis
                                        </button>
                                        <button
                                            v-if="loading"
                                            class="btn btn-danger"
                                            type="button"
                                            disabled
                                            style="border-radius: 20px"
                                        >
                                            <span
                                                class="spinner-grow spinner-grow-sm"
                                                role="status"
                                                aria-hidden="true"
                                            ></span>
                                            <span class="visually-hidden"
                                                >Loading...</span
                                            >
                                        </button>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                    <div
                        style="border-radius: 25px; padding: 15px"
                        v-if="report == true"
                    >
                        <div
                            class="row justify-content-center"
                            style="gap: 12px"
                        >
                            <div
                                class="col-2 p-2"
                                style="
                                    background-color: rgb(113, 180, 180);
                                    border-radius: 25px;
                                    color: white;
                                "
                            >
                                <h5
                                    class="text-center"
                                    style="font-weight: bold"
                                >
                                    Total stock
                                </h5>
                                <div class="text-center">
                                    <h3>{{ totalsale }}<span> SAR</span></h3>
                                </div>
                            </div>
                            <div
                                class="col-3 p-2"
                                style="
                                    background-color: rgb(34, 87, 185);
                                    border-radius: 25px;
                                    color: white;
                                "
                            >
                                <h5
                                    class="text-center"
                                    style="font-weight: bold"
                                >
                                    Monthly sale
                                </h5>
                                <div class="text-center">
                                    <h3>{{ monthlysale }} <span>SAR</span></h3>
                                </div>
                            </div>
                            <div
                                class="col-3 p-2"
                                style="
                                    background-color: rgb(92, 89, 255);
                                    border-radius: 25px;
                                    color: white;
                                "
                            >
                                <h5
                                    class="text-center"
                                    style="font-weight: bold"
                                >
                                    Total Quantity
                                </h5>
                                <div class="text-center">
                                    <h3>{{ totalquantity }} <span></span></h3>
                                </div>
                            </div>
                            <div
                                class="col-2 p-2"
                                style="
                                    background-color: #dc3545;
                                    border-radius: 25px;
                                    color: white;
                                "
                            >
                                <h5
                                    class="text-center"
                                    style="font-weight: bold"
                                >
                                    Quantity Sold
                                </h5>
                                <div class="text-center">
                                    <h3>{{ soldquantity }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        style="border-radius: 25px; padding: 15px"
                        v-if="analysiss == true && Bestseller != null"
                    >
                        <div
                            class="row justify-content-center"
                            style="gap: 12px"
                        >
                            <div
                                class="col-12 p-2"
                                style="
                                    background-color: #dc3545;
                                    border-radius: 25px;
                                    color: white;
                                "
                            >
                                <h5
                                    class="text-center"
                                    style="font-weight: bold"
                                >
                                    Best seller
                                </h5>
                                <div
                                    class="text-center d-flex justify-content-between"
                                >
                                    <div>
                                        product name
                                        <h3>{{ Bestseller[0].product }}</h3>
                                    </div>
                                    <div>
                                        total product price
                                        <h3>
                                            {{
                                                Bestseller[0].productdetails
                                                    .getproduct.price *
                                                Bestseller[0].totalquzntity
                                            }}
                                        </h3>
                                    </div>
                                    <div>
                                        total product quantity
                                        <h3>
                                            {{ Bestseller[0].totalquzntity }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Wrapper. Contains page content -->
                    <div v-if="reqerror" style="color: #dc3545">
                        {{ reqerror }}
                    </div>
                    <div v-else >
                        <h2>Order History</h2>
                        <div
                            class="card-body bg-white mb-5"
                            style="border-radius: 20px"
                        >
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Product code</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="(request, index) in allrequests"
                                        :key="request.id"
                                    >
                                        <td
                                            v-if="
                                                request.getuser.role === 'USER'
                                            "
                                            class="text-danger"
                                            style="font-weight: 1000"
                                        >
                                            {{ index + 1 }}
                                        </td>
                                        <td v-else>
                                            {{ index + 1 }}
                                        </td>

                                        <td>
                                            {{ request.getproduct.productname }}
                                        </td>
                                        <td>
                                            {{ request.getproduct.productcode }}
                                        </td>
                                        <td>
                                            <p class="text-primary">
                                                {{ request.statue }}
                                            </p>
                                        </td>

                                        <td>
                                            {{
                                                moment(
                                                    request.created_at
                                                ).format(format)
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.content -->
                    <!-- /.content-wrapper -->
                </div>
            </div>
        </div>
    </div>

    <div id="pdfgeneratereport" style="display: none">
        <div>
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12 m-0 text-center">
                            <h1 class="m-0">Report</h1>
                            <p class="m-0">
                                Date: {{ date }} <span> </span> time:
                                <span>{{ time }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="wrapper">
                        <h4>Analysis report</h4>
                        <div
                            style="
                                border-radius: 10px;
                                padding: 4px;
                                margin: 10px;
                            "
                        >
                            <div
                                class="row justify-content-between"
                                style="gap: 12px"
                            >
                                <div
                                    class="col-2 p-2"
                                    style="
                                        background-color: rgb(113, 180, 180);
                                        border-radius: 25px;
                                        color: white;
                                    "
                                >
                                    <p
                                        class="text-center"
                                        style="
                                            font-weight: bold;
                                            font-size: 100%;
                                        "
                                    >
                                        Total stock
                                    </p>
                                    <div class="text-center">
                                        <h6
                                            style="
                                                font-weight: bold;
                                                font-size: 100%;
                                            "
                                        >
                                            {{ totalsale }}<span> SAR</span>
                                        </h6>
                                    </div>
                                </div>
                                <div
                                    class="col-3 p-2"
                                    style="
                                        background-color: rgb(34, 87, 185);
                                        border-radius: 25px;
                                        color: white;
                                    "
                                >
                                    <p
                                        class="text-center"
                                        style="
                                            font-weight: bold;
                                            font-size: 100%;
                                        "
                                    >
                                        Monthly sale
                                    </p>
                                    <div class="text-center">
                                        <h6
                                            style="
                                                font-weight: bold;
                                                font-size: 100%;
                                            "
                                        >
                                            {{ monthlysale }}
                                            <span>SAR</span>
                                        </h6>
                                    </div>
                                </div>
                                <div
                                    class="col-3 p-2"
                                    style="
                                        background-color: rgb(92, 89, 255);
                                        border-radius: 25px;
                                        color: white;
                                    "
                                >
                                    <p
                                        class="text-center"
                                        style="
                                            font-weight: bold;
                                            font-size: 100%;
                                        "
                                    >
                                        Total Quantity
                                    </p>
                                    <div class="text-center">
                                        <h6
                                            style="
                                                font-weight: bold;
                                                font-size: 100%;
                                            "
                                        >
                                            {{ totalquantity }}
                                            <span></span>
                                        </h6>
                                    </div>
                                </div>
                                <div
                                    class="col-2 p-2"
                                    style="
                                        background-color: #dc3545;
                                        border-radius: 25px;
                                        color: white;
                                    "
                                >
                                    <p
                                        class="text-center"
                                        style="
                                            font-weight: bold;
                                            font-size: 100%;
                                        "
                                    >
                                        Quantity Sold
                                    </p>
                                    <div class="text-center">
                                        <h6
                                            style="
                                                font-weight: bold;
                                                font-size: 100%;
                                            "
                                        >
                                            {{ soldquantity }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Content Wrapper. Contains page content -->
                        <h4>Order History</h4>
                        <div
                            class="card-body bg-white"
                            style="border-radius: 20px"
                        >
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product name</th>
                                        <th>Product code</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr
                                        v-for="(request, index) in allrequests"
                                        :key="request.id"
                                    >
                                        <td
                                            v-if="
                                                request.getuser.role === 'USER'
                                            "
                                            class="text-danger"
                                            style="font-weight: 1000"
                                        >
                                            {{ index + 1 }}
                                        </td>
                                        <td v-else>
                                            {{ index + 1 }}
                                        </td>

                                        <td>
                                            {{ request.getproduct.productname }}
                                        </td>
                                        <td>
                                            {{ request.getproduct.productcode }}
                                        </td>
                                        <td>
                                            <p class="text-primary">
                                                {{ request.statue }}
                                            </p>
                                        </td>

                                        <td>
                                            {{
                                                moment(
                                                    request.created_at
                                                ).format(format)
                                            }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.content -->
                        <!-- /.content-wrapper -->
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="m-4">generate by : {{ currentuser.name }}</p>
                    <p class="m-4">2023 © All Rights Reserved Med-Verse</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { reactive, ref, onBeforeMount, onMounted } from "vue";
import { usetoaster } from "../../../../toaster.js";
import moment from "moment";
import html2pdf from "html2pdf.js";
const report = ref(false);
const analysiss = ref(false);
const dat = new Date();
const date = ref(dat.toLocaleDateString());
const time = ref(dat.toLocaleTimeString());

const format = window.Laravel.format;
const supplieruser = window.Laravel.user.role == "SUPPLIER";
const currentuser = window.Laravel.user;
const currentuseradmin = window.Laravel.user
    ? window.Laravel.user.role == "ADMIN"
    : "";
const filter = ref({
    request: "",
    group: "",
    month: "",
    year: "",
    user_id: currentuser.id,
});
const allrequest = ref([]);
const allrequests = ref([]);
const allgroup = ref([]);
const loading = ref(false);
const getallrequest = () => {
    axios.get(`/product`).then((response) => {
        allrequest.value = response.data;
    });
};
const getllgroups = () => {
    axios.get("/group").then((response) => {
        allgroup.value = response.data;
    });
};
const totalsale = ref(0);
const monthlysale = ref(0);
const totalquantity = ref(0);
const soldquantity = ref(0);
const reqerror = ref(null);
const submitform = () => {
    reqerror.value = null;
    axios
        .post(`/api/filter/${currentuser.id}`, filter.value)
        .then((response) => {
            allrequests.value = response.data.allrequest;
            totalsale.value = response.data.myinventory;
            monthlysale.value = response.data.monthlysale;
            totalquantity.value = response.data.totalquantity;
            soldquantity.value = response.data.soldquantity;
            if (totalsale.value > 0) {
                report.value = true;
            }
            const element = document.getElementById("pdfgeneratereport");
            element.style = "display:block";
            html2pdf().from(element).save("report.pdf");
            setTimeout(() => {
                element.style = "display:none";
            }, 0.01);
        })
        .catch((error) => {
            reqerror.value = "sorry you do not have any request until yet";
        });
};
const Bestseller = ref(null);
const submitform2 = (res) => {
    console.log(analysiss.value);
    if (res == true) {
        axios
            .post(`/api/analysis/${currentuser.id}`, filter.value)
            .then((response) => {
                Bestseller.value = Object(response.data.bestproduct);
                analysiss.value = true;
            });
    }
};
onMounted(() => {
    getallrequest();
    getllgroups();
});
</script>
