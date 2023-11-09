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
                        <h1 class="m-0">All Comments</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active">All coments</li>
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
                                                All comments
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>

                                                    <th>user name</th>
                                                    <th>user role</th>
                                                    <th>phone</th>
                                                    <th>title</th>
                                                    <th>comment</th>

                                                    <th>Date</th>

                                                    <th>action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr
                                                    v-for="(
                                                        comment, index
                                                    ) in allcoments"
                                                    :key="comment.id"
                                                >
                                                    <td>
                                                        {{ index + 1 }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            comment.getuser.name
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            comment.getuser.role
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{
                                                            comment.getuser
                                                                .phone
                                                        }}
                                                    </td>
                                                    <td>{{ comment.title }}</td>
                                                    <td>
                                                        {{ comment.comment }}
                                                    </td>

                                                    <td>
                                                        {{
                                                            moment(
                                                                comment.created_at
                                                            ).format(format)
                                                        }}
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <a
                                                                href="#"
                                                                @click="
                                                                    deletecomment(
                                                                        comment
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
import { onMounted, ref } from "vue";
import moment from "moment";
import { usetoaster } from "../../../../toaster.js";
const format = window.Laravel.format;

const allcoments = ref([]);
const toaster = usetoaster();

const reload = ref(false);
const commentidbeingDelete = ref(null);

const getallcomments = () => {
    reload.value = true;
    axios.get(`/comments`).then((response) => {
        console.log(response.data);
        allcoments.value = response.data;
        reload.value = false;
    });
};

const deletecomment = (comment) => {
    commentidbeingDelete.value = comment.id;
    $("#deleteModal").modal("show");
};

const confirmdelete = () => {
    axios
        .delete(`/comments/delete/${commentidbeingDelete.value}`)
        .then((response) => {
            allcoments.value = allcoments.value.filter(
                (comment) => comment.id !== commentidbeingDelete.value
            );

            $("#deleteModal").modal("hide");
            toaster.success("User deleted successfully!");
        });
};
onMounted(() => {
    getallcomments();
});
</script>
