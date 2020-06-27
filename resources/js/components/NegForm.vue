<template>
    <div class="modal fade text-left" id="negForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Inline Login Form </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="#" data-bitwarden-watching="1">
                    <div class="modal-body">
                        <label>Email: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Email Address" class="form-control">
                        </div>

                        <label>Password: </label>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>