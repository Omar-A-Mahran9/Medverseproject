<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="text-bold">
                        We aim for the best, providing the highest quality
                        products
                    </h3>
                    <p>
                        *All fields are mandatory,except mentioned as (optional)
                    </p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer Sercice</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="wrapper">
                <!-- Content Wrapper. Contains page content -->
                <section class="content">
                    <!-- /.row -->
                    <form @submit.prevent="customerservice" class="pb-5">
                        <div class="form-group">
                            <label for="exampleInputtitle">Title</label>
                            <input
                                style="background-color: #f2f2f2"
                                type="text"
                                name="title"
                                v-model="customerserviceo.title"
                                class="form-control"
                                id="exampleInputtitle"
                            />
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea
                                v-model="customerserviceo.comment"
                                style="background-color: #f2f2f2"
                                class="form-control"
                                rows="5"
                                id="comment"
                            ></textarea>
                        </div>

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
                    </form>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->

                <!-- /.content-wrapper -->
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { usetoaster } from "../../../../toaster.js";
const loading = ref(false);
const customerserviceo = ref({
    title: "",
    comment: "",
    user_id: window.Laravel.user.id,
});
const toaster = usetoaster();

const customerservice = () => {
    loading.value = true;
    // console.log(customerserviceo.value);
    axios
        .post("/api/customerservice", customerserviceo.value)
        .then((response) => {
            toaster.success("your comment send Successfuly");
            loading.value = false;
            customerserviceo.value.title=""
            customerserviceo.value.comment=""

        });
};
</script>
