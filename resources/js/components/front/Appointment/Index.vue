<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Welcome To Med-Verse</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
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
                                    <h5>All Appointments</h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Client</th>
                                                <th>Session item</th>
                                                <th>Session Date</th>
                                                <th>Session time</th>
                                                <th>Price</th>
                                                <th>statue</th>
                                                <th>Create Date</th>
                                                <th v-if="user.role == 'ADMIN'">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    appointment, index
                                                ) in Allappoint"
                                                :key="appointment.id"
                                            >
                                                <td>{{ index + 1 }}</td>
                                                <td>
                                                    {{
                                                        appointment
                                                            .appointmentuser
                                                            .name
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        appointment
                                                            .appointmentsession
                                                            .sessionname
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        appointment
                                                            .appointmentdate
                                                            .sessioncalender
                                                    }}
                                                </td>
                                                <td>
                                                    {{
                                                        appointment
                                                            .appointmenttime
                                                            .sessiontime
                                                    }}
                                                </td>
                                                <td>
                                                    {{ appointment.price }}
                                                </td>
                                                <td class="text-primary">
                                                    {{ appointment.statue }}
                                                </td>
                                                <td class="text-success">
                                                    {{
                                                        moment(
                                                            appointment.created_at
                                                        ).format(format)
                                                    }}
                                                </td>
                                                <td v-if="user.role == 'ADMIN'">
                                                    <div>
                                                        <a
                                                            v-if="
                                                                user.role ==
                                                                'ADMIN'
                                                            "
                                                            href="#"
                                                            @click="
                                                                deleteappointment(
                                                                    appointment
                                                                )
                                                            "
                                                            ><i
                                                                class="fas fa-trash text-danger"
                                                            ></i
                                                        ></a>
                                                        <p
                                                            v-else
                                                            class="text-success"
                                                        >
                                                            Done
                                                        </p>
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
                        Delete Session
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
                        Are you sure you want to delete this Session?
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
</template>
<script setup>
import { onMounted, reactive, ref } from "vue";
import { usetoaster } from "../../../toaster.js";
import axios from "axios";
import moment from "moment";
const format = window.Laravel.format;
const user = window.Laravel.user;
const errors = ref(null);
const Allappoint = ref([]);
const toaster = usetoaster();
const allappointment = () => {
    axios.get("/api/appointment").then((response) => {
        Allappoint.value = response.data;
    });
};
const confirmdelete = () => {};
const deleteappointment = (data) => {
    axios.delete(`/api/deleteappointment/${data.id}`).then((response) => {
        Allappoint.value = Allappoint.value.filter(
            (appointment) => appointment.id !== data.id
        );
        toaster.success("statue Changed Successfuly");
    });
};
onMounted(() => {
    allappointment();
});
</script>
