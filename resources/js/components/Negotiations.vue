<template>
    <div id="negotiationsModule" class="app-content content">
        <div class="content-overlay"></div>
        <div id="headerNavbarShadow" class="header-navbar-shadow"></div>
        <div id="contentWrapper" class="content-wrapper pt-1">
            <!-- Module control -->
            <negotiations-controls v-if="!getShowForm" />
            <div class="header-ventonic-blue" v-else>
                <div class="card-ventonic">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12 ">
                            <div class="text-ventonic-white">Negociaciones</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Lists View -->
            <section id="listView" class="row" v-if="getShowLists">
                <!-- Filters bar -->
                <negotiations-filters />
                <!-- Search and lists -->
                <div id="searchAndListsCol" class="col h-100">
                    <div class="content-body">
                        <div id="searchSection" class="row my-1">
                            <!-- Total of negotiations -->
                            <div class="col-12 mb-1">
                                <div class="search-results text-white">
                                    Tiene {{ totalNegotiations }} negociaciones en total
                                </div>
                            </div>
                            <!-- Search bar -->
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <button type="button"
                                            class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light d-block d-lg-none">
                                        <i class="fa fa-sliders"></i>
                                    </button>
                                    <div class="search-bar w-100">
                                        <form>
                                            <fieldset class="form-group position-relative mb-1">
                                                <input type="text" class="form-control" id="searchbar"
                                                       placeholder="Buscar..." v-model.trim="search" />
                                                <div class="form-control-position">
                                                    <i class="feather icon-search pr-2"></i>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Filer badges -->
                            <div class="col-xs-12 col">
                                <!--
                                <div class="badge badge-md badge-warning mr-1 filterBadge">Info<i class="feather icon-x"></i></div>
                                <div class="badge badge-md badge-warning mr-1 filterBadge">Info<i class="feather icon-x"></i></div>
                                <div class="badge badge-md badge-warning mr-1 filterBadge">Info<i class="feather icon-x"></i></div>
                                <div class="badge badge-md badge-warning mr-1 filterBadge">Info<i class="feather icon-x"></i></div>
                                <div class="badge badge-md badge-warning mr-1 filterBadge">Info<i class="feather icon-x"></i></div>

                -->
                            </div>
                            <!-- Total of found negotiations -->
                            <div class="col-xs-12 col-lg-auto">
                                <span>30 negociaciones encontradas</span>
                            </div>
                        </div>
                        <!-- Lists -->
                        <perfect-scrollbar class="ps-width">
                            <div id="listsContainer" class="lists">
                                <negotiations-list class="list" v-for="(proc) in getProcesses" :key="proc.id"
                                                   :process="proc" />
                            </div>
                        </perfect-scrollbar>
                    </div>
                </div>
            </section>
            <!-- Negotiation Form -->
            <negotiation-form v-if="getShowForm" />
            <!-- Negotiation Details -->
            <negotiation-details v-if="getShowDetails" />
            <!-- Note Modal -->
            <todo-form v-if="getShowNoteForm" />
            <!-- Event Modal -->
            <negotiation-event-modal v-if="getShowEventForm" />
            <!-- Files Modal -->
            <negotiation-file-modal v-if="getShowFileForm" />
            <!-- Confirm Modal -->
            <negotiation-confirm-modal v-if="getShowConfirm" />
            <div class="modal-backdrop fade show" v-if="getShowConfirm"></div>
        </div>
    </div>
</template>
<script>
    import { mapMutations, mapGetters, mapActions } from "vuex";
    import draggable from "vuedraggable";
    export default {
        components: {
            draggable
        },
        data() {
            return {
                window: {
                    width: 0,
                    height: 0
                }
            };
        },
        props: [
            "types",
            "statuses",
            "processes",
            "negotiations",
            "user",
            "contacts",
            "a"
        ],
        created() {
            // Capture everytime window gets resized.
            window.addEventListener("load", this.updateModuleSizes);
            window.addEventListener("resize", this.handleResize);
            this.setFooterStyles();
        },
        mounted() {
            // Get window actual size.
            this.handleResize();

            this.setUserId(this.user);
            this.setTypes(this.types);
            this.setStatuses(this.statuses);
            this.setProcesses(this.processes.processes);
            this.setContacts(this.contacts);
            this.setUserGroups(this.a);
            this.setNegotiations(this.negotiations);
        },
        destroyed() {
            // Remove events listener
            window.removeEventListener("resize", this.handleResize);
            window.addEventListener("load", this.updateModuleSizes);
        },
        methods: {
            ...mapActions(["toggleActivation"]),
            ...mapMutations({
                setHeaderNavbarShadowHeight: "SET_HEADER_NAVBAR_SHADOW_HEIGHT",
                setUserId: "SET_USER_ID",
                setTypes: "SET_TYPES",
                setStatuses: "SET_STATUSES",
                setProcesses: "SET_PROCESSES",
                setContacts: "SET_CONTACTS",
                setUserGroups: "SET_USER_GROUPS",
                setNegotiations: "SET_NEGOTIATIONS",
                separateNegotiations: "SEPARATE_NEGOTIATIONS",
                setSearch: "SET_SEARCH"
            }),
            handleResize() {
                // Get window height and width.
                this.window.width = window.innerWidth;
                this.window.height = window.innerHeight;

                if (document.body.querySelector("#navControls") !== null) {
                    this.updateModuleSizes();
                }
            },
            updateModuleSizes() {
                // Ventonic ppal menu options.
                let ventonicMenuWidth = document.body.querySelector("div.main-menu").offsetWidth;
                // Header navbar shadow.
                let headerNavbarShadowHeight = document.body.querySelector(
                    "#headerNavbarShadow"
                ).offsetHeight;
                // Nav Controls.
                let navControlsHeight = document.body.querySelector("#navControls").offsetHeight;
                // App Footer.
                let appFooterHeight = document.body.querySelector("#appFooter").offsetHeight;
                // Filters bar.
                let lgFiltersBarWidth = null;
                // let lgFiltersBarWidth = document.querySelector('#lgFiltersBar').offsetWidth; // Filters bar.
                // Filters bar.
                let lgFiltersBarHeight = null;
                let searchAndListsColWidth = null;
                let listsContainerHeight = null;

                let listViewHeight = this.window.height - (
                    headerNavbarShadowHeight + navControlsHeight + appFooterHeight
                );

                // Set list view height.
                document.body.querySelector("#listView").style.height = listViewHeight + "px";
                document.body.querySelector("#listView").style.maxHeight = listViewHeight + "px";

                // Filters width.
                document.querySelector("#lgFiltersBar").style.width = "350px";
                document.querySelector("#lgFiltersBar").style.maxWidth = "350px";
                // Filters bar.
                lgFiltersBarWidth = document.querySelector("#lgFiltersBar").offsetWidth;
                // Filters height.
                document.querySelector("#lgFiltersBar").style.height = listViewHeight + "px";
                lgFiltersBarHeight = document.querySelector("#lgFiltersBar").offsetHeight;

                // Set filters card height.
                document.body.querySelector("#filtersCard").style.height = lgFiltersBarHeight - (
                    document.querySelector("#lgFiltersBar").children[0].offsetHeight + 32
                ) + "px";

                // Set search & bar width.
                document.body.querySelector("#searchAndListsCol").style.width = this.window.width - (
                    ventonicMenuWidth + lgFiltersBarWidth + 56
                ) + "px";
                searchAndListsColWidth = document.querySelector("#searchAndListsCol").offsetWidth;
                document.body.querySelector("#listsContainer").style.width = searchAndListsColWidth - 28 + "px";
                document.body.querySelector("#listsContainer").style.height = document.querySelector(
                    "#searchAndListsCol"
                ).offsetHeight - (document.body.querySelector("#searchSection").offsetHeight + 32) + "px";

                listsContainerHeight = document.body.querySelector("#listsContainer").offsetHeight;

                // Cards height
                let listHeaderHeight = document.body.querySelector(".headerList").offsetHeight;
                let listFooterHeight = document.body.querySelector(".footerList").offsetHeight;

                document.body.querySelectorAll(".dragElements").forEach(ul => {
                    ul.style.height = listsContainerHeight - 15 - (listHeaderHeight + listFooterHeight) + "px";
                });
            },
            setFooterStyles() {
                let footer = document.body.querySelector("#appFooter");
                footer.style.position = "absolute";
                footer.style.bottom = 0;
                footer.style.right = 0;
            }
        },
        computed: {
            ...mapGetters([
                "getShowLists",
                "getShowForm",
                "getShowDetails",
                "getShowNoteForm",
                "getShowEventForm",
                "getShowFileForm",
                "getShowConfirm",
                "getProcesses",
                "getNegotiations",
                "getSearch"
            ]),
            search: {
                get() {
                    return this.getSearch;
                },
                set(val) {
                    this.setSearch(val);
                }
            },
            totalNegotiations() {
                return this.getNegotiations.length;
            }
        }
    };
</script>
<style lang="scss">
    /* Some Sass variables */
    // Layout
    $list-width: 330px;
    $gap: 10px;
    // Misc
    $list-border-radius: 5px;
    $card-border-radius: 3px;

    // Colors
    $list-bg-color: #10163a;

    /* Content Right */
    /* Filters badge */
    .filterBadge,
    .filterBadge .feather {
        color: #000000 !important;
        font-weight: bolder !important;
        margin: 0px 0px 5px 0px !important;
    }

    .ps-width {
        width: max-content;
    }

    .lists {
        display: flex;

        >.list {
            flex: 0 0 auto; // 'rigid' lists
            margin-left: $gap;
        }

        &::after {
            content: "";
            flex: 0 0 $gap;
        }
    }

    .list {
        width: $list-width;

        >* {
            background-color: $list-bg-color;
            color: #c2c6dc;

            padding: 0 $gap;
        }

        .headerList {
            font-size: 16px;
            font-weight: bold;
            border-top-left-radius: $list-border-radius;
            border-top-right-radius: $list-border-radius;
        }

        .footerList {
            border-bottom-left-radius: $list-border-radius;
            border-bottom-right-radius: $list-border-radius;
            color: #888;
        }

        .dragElements {
            list-style: none;
            margin: 0;

            li {
                background-color: #262c49 !important;
                padding: $gap;

                &:not(:last-child) {
                    margin-bottom: $gap;
                }

                border-radius: $card-border-radius;
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            }
        }
    }

    /* Filters Sidebar */
    #lgFiltersBar {
        max-height: calc(100 - (63 + 102 + 95 + 81));
    }

    .vdp-datepicker__calendar {
        position: absolute !important;
        z-index: 100 !important;
        background: #262c49 !important;
        width: 300px !important;
        border: 1px solid #ccc !important;
    }

    .vdp-datepicker__calendar .cell.highlighted {
        background: #10163a !important;
    }

    .vdp-datepicker__calendar header .up:not(.disabled):hover {
        background: transparent !important;
    }

    @media (min-width: 992px) {
        body .content-detached.content-right .content-body {
            margin-left: calc(260px + 0.5rem) !important;
        }
    }
</style>
