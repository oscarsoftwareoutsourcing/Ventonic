<template>
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="app-content-overlay"></div>
            <div class="todo-app-area">
                <div class="todo-app-list-wrapper">
                    <div class="todo-app-list">

                        <!-- search input -->
                        <div class="app-fixed-search">
                            <div class="sidebar-toggle d-block d-lg-none"><i class="feather icon-menu"></i></div>
                            <fieldset class="form-group position-relative has-icon-left m-0">
                                <input type="text" class="form-control" id="todo-search" placeholder="Search...">
                                <div class="form-control-position">
                                    <i class="feather icon-search"></i>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Notes list -->
                        <div class="todo-task-list list-group ps ps--active-y">
                            <ul class="todo-task-list-wrapper media-list" v-if="notes.length !== 0">

                                <!-- Note -->
                                <li class="todo-item" data-toggle="modal" data-target="#todoForm">
                                    <div class="todo-title-wrapper d-flex justify-content-between mb-50">
                                        <div class="todo-title-area d-flex align-items-center">
                                            <div class="title-wrapper d-flex">
                                                <div class="vs-checkbox-con">
                                                    <input type="checkbox">
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <h6 class="todo-title mt-50 mx-50">Meet Jane ❤️</h6>
                                            </div>
                                            <div class="chip-wrapper">
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="Frontend"><span class="bullet bullet-primary bullet-xs"></span> Frontend</span>
                                                    </div>
                                                </div>
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="Backend"><span class="bullet bullet-warning bullet-xs"></span> Backend</span>
                                                    </div>
                                                </div>
                                                <div class="chip mb-0">
                                                    <div class="chip-body">
                                                        <span class="chip-text" data-value="Doc"><span class="bullet bullet-success bullet-xs"></span> Doc</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="float-right todo-item-action d-flex">
                                            <a class="todo-item-info success"><i class="feather icon-info"></i></a>
                                            <a class="todo-item-favorite warning"><i class="feather icon-star"></i></a>
                                            <a class="todo-item-delete"><i class="feather icon-trash"></i></a>
                                        </div>
                                    </div>
                                    <p class="todo-desc truncate mb-0">Toffee sugar plum oat cake tiramisu tart bonbon gingerbread cheesecake cake.</p>
                                </li>
                            </ul>
                            <div class="no-results">
                                <h5>No Items Found</h5>
                            </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 385px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 231px;"></div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['notes'],
    data() {
        return {

        }
    }
}
</script>

<style>

</style>