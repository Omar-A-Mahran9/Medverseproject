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
                        <li class="breadcrumb-item active">Events</li>
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
                                    <h5>All Events</h5>

                                    <div class="">
                                        <button
                                            v-if="user.role == 'ADMIN'"
                                            class="btn btn-danger"
                                            @click="addnewevent"
                                        >
                                            Add New Event
                                            <i
                                                class="fas fa-plus ml-2 mr-2"
                                            ></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Event Details</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    event, index
                                                ) in allevent"
                                                :key="event.id"
                                            >
                                                <td
                                                    style="
                                                        vertical-align: middle;
                                                    "
                                                >
                                                    {{ index + 1 }}
                                                </td>
                                                <td>
                                                    <div
                                                        class="d-flex align-items-center"
                                                    >
                                                        <div>
                                                            <img
                                                                :src="
                                                                    imageUrl +
                                                                    '/' +
                                                                    event.image
                                                                "
                                                                width="150"
                                                                alt="User Avatar"
                                                                class="img-size-60 img-circle mr-3"
                                                            />
                                                        </div>
                                                        <div>
                                                            <h4>
                                                                <b>{{
                                                                    event.eventname
                                                                }}</b>
                                                            </h4>
                                                            <p>
                                                                {{
                                                                    event.eventlocation
                                                                }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td
                                                    style="
                                                        vertical-align: middle;
                                                    "
                                                >
                                                    {{
                                                        moment(
                                                            event.eventdate
                                                        ).format(format)
                                                    }}
                                                </td>
                                                <td
                                                    style="
                                                        vertical-align: middle;
                                                    "
                                                >
                                                    <a
                                                        v-if="
                                                            user.role != 'ADMIN'
                                                        "
                                                        class="btn btn-success"
                                                        :href="event.eventlink"
                                                        style="
                                                            color: #ffffff;

                                                            border-radius: 20px;
                                                        "
                                                        >Apply Now</a
                                                    >
                                                    <a
                                                        v-if="
                                                            user.role ===
                                                            'ADMIN'
                                                        "
                                                        class="mr-4"
                                                        href="#"
                                                        @click="
                                                            editevent(event)
                                                        "
                                                        ><i
                                                            class="fas fa-pen text-white bg-primary rounded p-1"
                                                        ></i
                                                    ></a>
                                                    <a
                                                        v-if="
                                                            user.role == 'ADMIN'
                                                        "
                                                        href="#"
                                                        @click="
                                                            deleteevent(event)
                                                        "
                                                        ><i
                                                            class="fas fa-trash text-danger"
                                                        ></i
                                                    ></a>
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
    <div id="addeventmodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new Event</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="addevent">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="eventname">Event name</label>
                                <p
                                    v-if="errors && errors.eventname"
                                    class="text text-danger"
                                >
                                    {{ errors.eventname[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="event.eventname"
                                    name="eventname"
                                    id="eventname"
                                    placeholder="Enter event name"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="eventdate">Date of Event</label>
                                <p
                                    v-if="errors && errors.eventdate"
                                    class="text text-danger"
                                >
                                    {{ errors.eventname[0] }}*
                                </p>
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="event.eventdate"
                                    name="eventdate"
                                    id="eventdate"
                                    placeholder="Enter event date"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="eventname">Event Link</label>
                                <p
                                    v-if="errors && errors.eventlink"
                                    class="text text-danger"
                                >
                                    {{ errors.eventlink[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="event.eventlink"
                                    name="eventlink"
                                    id="eventlink"
                                    placeholder="Enter event link"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="eventname">Event Location</label>
                                <p
                                    v-if="errors && errors.eventlocation"
                                    class="text text-danger"
                                >
                                    {{ errors.eventlocation[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="event.eventlocation"
                                    name="eventlocation"
                                    id="eventlocation"
                                    placeholder="Enter event location"
                                />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile">Image</label>
                                <p
                                    v-if="errors && errors.eventimage"
                                    class="text text-danger"
                                >
                                    {{ errors.eventimage[0] }}*
                                </p>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                            name="event_image"
                                            @change="handleimage"
                                        />
                                        <label
                                            v-if="event.eventimage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >{{ event.eventimage.name }}</label
                                        >
                                        <label
                                            v-if="!event.eventimage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >Choose file
                                        </label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            >Upload</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            Add Event
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
    <div id="editeventmodal" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Event</h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editeventnow">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="eventname">Event name</label>
                                <p
                                    v-if="errors && errors.eventname"
                                    class="text text-danger"
                                >
                                    {{ errors.eventname[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="event.eventname"
                                    name="eventname"
                                    id="eventname"
                                    placeholder="Enter event name"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="eventdate">Date of Event</label>
                                <p
                                    v-if="errors && errors.eventdate"
                                    class="text text-danger"
                                >
                                    {{ errors.eventname[0] }}*
                                </p>
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="event.eventdate"
                                    name="eventdate"
                                    id="eventdate"
                                    placeholder="Enter event date"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="eventname">Event Link</label>
                                <p
                                    v-if="errors && errors.eventlink"
                                    class="text text-danger"
                                >
                                    {{ errors.eventlink[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="event.eventlink"
                                    name="eventlink"
                                    id="eventlink"
                                    placeholder="Enter event link"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="eventname">Event Location</label>
                                <p
                                    v-if="errors && errors.eventlocation"
                                    class="text text-danger"
                                >
                                    {{ errors.eventlocation[0] }}*
                                </p>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="event.eventlocation"
                                    name="eventlocation"
                                    id="eventlocation"
                                    placeholder="Enter event location"
                                />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile">Image</label>
                                <p
                                    v-if="errors && errors.eventimage"
                                    class="text text-danger"
                                >
                                    {{ errors.eventimage[0] }}*
                                </p>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input
                                            type="file"
                                            class="custom-file-input"
                                            id="exampleInputFile"
                                            name="event_image"
                                            @change="handleimage"
                                        />
                                        <label
                                            v-if="event.eventimage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >{{ event.eventimage.name }}</label
                                        >
                                        <label
                                            v-if="!event.eventimage"
                                            class="custom-file-label"
                                            for="exampleInputFile"
                                            >Choose file
                                        </label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"
                                            >Upload</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">
                            update Event
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
</template>
<script setup>
import { onMounted, reactive, ref } from "vue";
import { usetoaster } from "../../../toaster.js";
import axios from "axios";
import moment from "moment";
const imageUrl = new URL("../../../../../storage", import.meta.url);
const update = ref(false);
const format = window.Laravel.format;
const user = window.Laravel.user;
const errors = ref(null);
const eventidbeingedit = ref();
const eventidbeingDelete = ref();
const toaster = usetoaster();
const allevent = ref([]);
const deleteevent = (event) => {
    eventidbeingDelete.value = event.id;
    $("#deleteModal").modal("show");
};
const event = ref({
    eventname: "",
    eventlink: "",
    eventdate: "",
    eventimage: "",
    eventlocation: "",
});
const handleimage = (e) => {
    const file = e.target.files[0];
    event.value.eventimage = file;
};

const confirmdelete = () => {
    axios
        .delete(`/api/event/delete/${eventidbeingDelete.value}`)
        .then((response) => {
            allevent.value = allevent.value.filter(
                (event) => event.id !== eventidbeingDelete.value
            );
            $("#deleteModal").modal("hide");
            toaster.success("event delete successfully!");
        });
};
const addnewevent = () => {
    event.value.eventname = "";
    event.value.eventdate = "";
    event.value.eventlink = "";
    event.value.eventimage = null;
    event.value.eventlocation = "";
    $("#addeventmodal").modal("show");
};
const allevents = () => {
    axios.get("/api/events").then((response) => {
        allevent.value = response.data;
    });
};
const addevent = () => {
    update.value = false;

    if (user.role == "ADMIN") {
        const formData = new FormData();
        formData.append("eventname", event.value.eventname);
        formData.append("eventdate", event.value.eventdate);
        formData.append("eventlink", event.value.eventlink);
        formData.append("eventimage", event.value.eventimage);
        formData.append("eventlocation", event.value.eventlocation);
        axios
            .post("/addevent", formData)
            .then((response) => {
                allevent.value.unshift(response.data);
                toaster.success("Event Added Successfully");
                $("#addeventmodal").modal("hide");
                errors.value = null;
            })
            .catch((error) => {
                errors.value = error.response.data.errors;
                loading.value = false;
            });
    }
};

const editevent = (data) => {
    update.value = true;
    eventidbeingedit.value = data.id;
    event.value.eventname = data.eventname;
    event.value.eventdate = data.eventdate;
    if (data.image != null) {
        event.value.eventimage = data.image;
    }
    event.value.eventlink = data.eventlink;
    event.value.eventlocation = data.eventlocation;
    $("#editeventmodal").modal("show");
};
const editeventnow = () => {
    const formData = new FormData();
    formData.append("eventid", eventidbeingedit.value);
    formData.append("eventname", event.value.eventname);
    formData.append("eventdate", event.value.eventdate);
    formData.append("eventlink", event.value.eventlink);
    if (event.value.eventimage != null) {
        formData.append("eventimage", event.value.eventimage);
    }
    formData.append("eventlocation", event.value.eventlocation);

    axios
        .post(`/api/event/edit/${eventidbeingedit.value}`, formData)
        .then((response) => {
            $("#editeventmodal").modal("hide");
            event.value.eventname = "";
            event.value.eventdate = "";
            event.value.eventlink = "";
            event.value.eventimage = null;
            event.value.eventlocation = "";
            const index = allevent.value.findIndex(
                (event) => event.id === response.data.id
            );
            allevent.value[index] = response.data;
            toaster.success("event updated successfully!");
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
            loading.value = false;
        });
};

onMounted(() => {
    allevents();
});
</script>
