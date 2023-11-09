<template>
    <div
        v-if="reload"
        class="spinner-grow text-danger"
        style="margin: 50%"
        role="status"
    ></div>
    <div v-if="!reload">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Orders</li>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div
                                        class="pl-5 pr-5 pt-4 d-flex align-items-center justify-content-between"
                                    >
                                        <div>
                                            <h3 class="card-title">
                                                All Orders
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>clinics</th>
                                                    <th>Price</th>
                                                    <th>Statue</th>

                                                    <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        order, index
                                                    ) in Allorders"
                                                    :key="order.id"
                                                >
                                                    <td>{{ index + 1 }}</td>
                                                    <td>
                                                        <p class="">
                                                            {{
                                                                order.userorder
                                                                    .name
                                                            }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="">
                                                            {{
                                                                order.userorder
                                                                    .email
                                                            }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p class="">
                                                            {{
                                                                order.userorder
                                                                    ?.phone ??
                                                                "not found"
                                                            }}
                                                        </p>
                                                    </td>

                                                    <td
                                                        style="
                                                            padding: 0%;
                                                            vertical-align: 0;
                                                        "
                                                        class="row align-items-center justify-content-center"
                                                    >
                                                        <div
                                                            class="col-12 col-md-6 pr-3"
                                                            style="
                                                                margin-right: -40px;
                                                            "
                                                        >
                                                            <h1
                                                                style="
                                                                    font-weight: bold;
                                                                "
                                                            >
                                                                {{
                                                                    order.number_of_clincs
                                                                }}
                                                            </h1>
                                                        </div>

                                                        <div
                                                            class="col-12 col-md-6 p-2"
                                                            style="
                                                                border-radius: 20px;
                                                            "
                                                        >
                                                            <p
                                                                class="text-center"
                                                                style="
                                                                    margin-top: 0;
                                                                    margin-bottom: 0rem;
                                                                "
                                                                v-for="clinic in order.clinics"
                                                                :key="clinic.id"
                                                            >
                                                                {{
                                                                    clinic.clinicname
                                                                }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ order.total_price }}
                                                        $
                                                    </td>
                                                    <td class="text-primary">
                                                        {{ order.statue }}
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <!-- <a
                                                                class="mr-4"
                                                                href="#"
                                                                @click="
                                                                    editrequest(
                                                                        request
                                                                    )
                                                                "
                                                                ><i
                                                                    class="fas fa-pen text-white bg-primary rounded p-1"
                                                                ></i
                                                            ></a> -->
                                                            <a
                                                                href="#"
                                                                @click="
                                                                    deleteorder(
                                                                        order
                                                                    )
                                                                "
                                                                ><i
                                                                    class="fas fa-trash text-danger"
                                                                ></i
                                                            ></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.container-fluid -->
                    </section>
                    <!-- /.content -->

                    <!-- /.content-wrapper -->
                </div>
            </div>
        </div>
        <div
            id="deleteModal"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            id="exampleModalLabel"
                            style="font-weight: bold"
                        >
                            Delete Request
                        </h5>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true" class="text-danger"
                                >&times;</span
                            >
                        </button>
                    </div>

                    <div class="modal-body">
                        <h5 class="text-cneter fw-bold">
                            Are you sure you want to delete this Request?
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button
                            @click.prevent="confirmdelete"
                            type="submit"
                            class="btn btn-danger"
                        >
                            Delete Request
                        </button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { usetoaster } from "../../../../toaster.js";
const toaster = usetoaster();
import { onMounted, reactive, ref } from "vue";
const reload = ref(false);
const Allorders = ref([]);
const orderbeingDelete = ref(null);
const order = ref({
    productname: "",
    productdescription: "",
    clientname: "",
    suppliername: "",
    image: "",
    quantity: "",
});

// const getuser = () => {
//     axios.get("/api/usersobject").then((response) => {
//         users.value = response.data;
//     });
// };
const getallorders = () => {
    reload.value = true;
    axios.get("/api/order").then((response) => {
        Allorders.value = response.data;
        reload.value = false;
    });
};
const deleteorder = (order) => {
    orderbeingDelete.value = order.id;
    console.log(orderbeingDelete.value);
    $("#deleteModal").modal("show");
};
// const editrequest = (request) => {
//     // form.value.reset();
//     $("#editformmodal").modal("show");
//     formValues.value = request;
// };
const confirmdelete = () => {
    axios
        .delete(`/api/order/delete/${orderbeingDelete.value}`)
        .then((response) => {
            Allorders.value = Allorders.value.filter(
                (order) => order.id !== orderbeingDelete.value
            );

            $("#deleteModal").modal("hide");
            toaster.success("Order deleted successfully!");
        });
};
onMounted(() => {
    getallorders();
});
</script>
