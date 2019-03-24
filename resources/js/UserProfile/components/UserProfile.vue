<template>
    <div class="container">
        <loading :active.sync="isLoading"
                 :can-cancel="false"
                 :is-full-page="fullPage"></loading>
        <div v-if="user" class="main-content-container container-fluid px-4">
            <!-- Page Header -->
            <div class="page-header row no-gutters py-4">
                <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
                    <span class="text-uppercase page-subtitle">Overview</span>
                    <h3 class="page-title">User Profile</h3>
                </div>
            </div>
            <!-- End Page Header -->
            <!-- Default Light Table -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-small mb-4 pt-3">
                        <div class="card-header border-bottom text-center">
                            <div class="mb-3 mx-auto ">
                                <avatar :username="user.name"
                                        :size="100">
                                </avatar>
                            </div>
                            <h4 class="mb-0">{{this.user.name}}</h4>
                            <span class="text-muted d-block mb-2">Project Manager</span>
                            <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2">
                                <i class="material-icons mr-1">person_add</i>Follow
                            </button>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-4">
                                <div class="progress-wrapper">
                                    <strong class="text-muted d-block mb-2">Workload</strong>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="74"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 74%;">
                                            <span class="progress-value">74%</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-4">
                                <strong class="text-muted d-block mb-2">Description</strong>
                                <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio eaque, quidem, commodi soluta qui quae minima obcaecati quod dolorum sint alias, possimus illum assumenda eligendi cumque?</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-small mb-4">
                        <div class="card-header border-bottom">
                            <h6 class="m-0">Account Details</h6>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                                <div class="row">
                                    <div class="col">
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="feFirstName">Name</label>
                                                    <input type="text" class="form-control" id="feFirstName"
                                                           placeholder="First Name" value="Sierra"></div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="feEmailAddress">Email</label>
                                                    <input type="email" class="form-control" id="feEmailAddress"
                                                           placeholder="Email" :value="user.email"></div>
                                                <!--TODO: reset password-->
                                                <!--<div class="form-group col-md-6">-->
                                                    <!--<label for="fePassword">Password</label>-->
                                                    <!--<input type="password" class="form-control" id="fePassword"-->
                                                           <!--placeholder="Password">-->
                                                <!--</div>-->
                                            </div>
                                            <button type="submit" class="btn btn-accent">Update Account</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Default Light Table -->
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar'
    import {getAuth as getAuthUser} from '../API/userAPI'
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        data() {
            return {
                user: null,
                isLoading: false,
                fullPage: true
            }
        },
        created() {
            this.isLoading = true;

            getAuthUser().then(result => {
                //TODO: remove .data
                this.user = result.data;
                this.isLoading = false

            }).catch(error => {
                console.log(' error !', error);
            });

        }
        ,
        components: {
            Avatar,
            Loading
        }
    }
</script>
