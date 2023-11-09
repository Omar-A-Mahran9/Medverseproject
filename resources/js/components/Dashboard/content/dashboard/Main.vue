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
                    <div class="col-sm-6"></div>
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

        <div class="text-center">
            <h1>
                Welcome
                <span class="text-primary fw-bold">{{ currentuser.name }}</span> To
                Med-Verse
            </h1>
            <br />
            <a
                href="/admin/profile"
                :to="profile"
                class="btn btn-primary"
                style="background-color: #1d617a; border: none"
            >
                My Profile
            </a>
        </div>
    </div>
</template>
<style scoped></style>
<script setup>
const currentuser = window.Laravel.user;
</script>
