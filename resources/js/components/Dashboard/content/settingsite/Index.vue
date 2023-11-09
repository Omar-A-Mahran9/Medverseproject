<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">New Request</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Website setting</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-danger m-5">
        <div class="card-header">
            <h3 class="card-title">Setting</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form ref="form" @submit.prevent="updatesettings">
            <div class="card-body">
                <div class="form-group">
                    <label for="clientname">App NAme</label>
                    <span
                        v-if="errors && errors.app_Name"
                        class="text text-danger"
                    >
                        {{ errors.app_Name[0] }}*
                    </span>
                    <input
                        type="text"
                        class="form-control"
                        v-model="setting.app_Name"
                    />
                </div>

                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="clientname">Price</label>
                        <span
                            v-if="errors && errors.clincprice"
                            class="text text-danger"
                        >
                            {{ errors.clincprice[0] }}*
                        </span>
                        <input
                            type="number"
                            class="form-control"
                            v-model="setting.clincprice"
                        />
                    </div>
                    <div class="form-group col-4">
                        <label for="clientname">Date Formate</label>
                        <span
                            v-if="errors && errors.data_format"
                            class="text text-danger"
                        >
                            {{ errors.data_format[0] }}*
                        </span>
                        <select
                            name="productname"
                            v-model="setting.data_format"
                            class="form-control"
                        >
                            <option hidden selected>choose Date Formate</option>
                            <option
                                :selected="setting.data_format === 'MM/DD/YYYY'"
                                vaue="MM/DD/YYYY"
                            >
                                MM/DD/YYYY
                            </option>
                            <option
                                :selected="setting.data_format === 'MM/DD/YYYY'"
                                vaue="YYYY/DD/MM"
                            >
                                YYYY/DD/MM
                            </option>
                            <option
                                :selected="setting.data_format === 'MM/DD/YYYY'"
                                vaue="YYYY/MM/DD"
                            >
                                YYYY/MM/DD
                            </option>
                            <option
                                :selected="setting.data_format === 'MM/DD/YYYY'"
                                vaue="DD/MM/YYYY"
                            >
                                DD/MM/YYYY
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="clientname">pagination limit</label>
                        <span
                            v-if="errors && errors.paginationlimit"
                            class="text text-danger"
                        >
                            {{ errors.paginationlimit[0] }}*
                        </span>
                        <input
                            type="number"
                            class="form-control"
                            v-model="setting.paginationlimit"
                        />
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button
                    v-if="!loading"
                    type="submit"
                    class="btn btn-danger pr-5 pl-5"
                >
                    Submit
                </button>
                <button
                    v-if="loading"
                    class="btn btn-danger"
                    type="button"
                    disabled
                >
                    <span
                        class="spinner-grow spinner-grow-sm"
                        role="status"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Loading...</span>
                </button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { usetoaster } from "../../../../toaster.js";
const toaster = usetoaster();
const errors = ref();
import { ref } from "vue";
import axios from "axios";
import { onMounted } from "vue";
const loading = ref(false);
const setting = ref([]);
const getsettings = () => {
    axios.get("/api/settings").then((response) => {
        setting.value = response.data;
    });
};
const updatesettings = () => {
    errors.value = "";
    loading.value = true;
    axios
        .post("/api/settings", setting.value)
        .then((response) => {
            loading.value = false;
            location.reload();
            toaster.success("Setting update Successfully");
        })
        .catch((error) => {
            loading.value = false;
            errors.value = error.response.data.errors;
        });
};
onMounted(() => {
    getsettings();
});
</script>
