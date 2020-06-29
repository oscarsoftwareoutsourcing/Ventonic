<template>
    <div class="card negotiation-card p-1 mb-1">
        <div class="card-content">
            <div class="card-body text-center p-0">

                <!-- Title -->
                <h4>{{ data.title }}</h4>
                
                <!-- Description -->
                <p>{{ data.description }}</p>
                
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
</template>

<script>
export default {
    props: ['data'],
}
</script>

<style>

</style>