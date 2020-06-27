<template>
    <div class="col-md-5 col-lg-4 mr-1">

        <!-- Title -->
        <div class="card card-block mb-1">
            <div class="card-body text-center">{{ title }}</div>
        </div>

        <!-- Cards -->
        <div class="card card-block">
            <div class="card-body p-1">

                <draggable>
                    <!-- Negotiation card -->
                    <div class="card negotiation-card p-1 mb-1">
                        <div class="card-content">
                            <div class="card-body text-center p-0">

                                <!-- Title -->
                                <h4>Zoila Legore</h4>
                                
                                <!-- Description -->
                                <p>Backend Dev</p>
                                
                                <hr class="my-2">
                                <div class="d-flex justify-content-between">
                                    <div class="float-left">
                                        <i class="feather icon-star text-warning mr-50"></i> 4.9
                                    </div>
                                    <div class="float-right">
                                        <i class="feather icon-briefcase text-primary mr-50"></i> 37 Projects
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </draggable>
            

            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';
export default {
    components: {
        draggable
    },
    props: ['title'],
}
</script>

<style>
    .negotiation-card {
        background-color: #262C49 !important;
    }
</style>