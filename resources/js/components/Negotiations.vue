<template>
  <div id="negotiationsModule" class="app-content content">
    <div class="content-overlay"></div>
    <div id="headerNavbarShadow" class="header-navbar-shadow"></div>
    <div id="contentWrapper" class="content-wrapper pt-1">
      <!-- Module control -->
      <negotiations-controls v-if="!getShowForm && !getShowDetails" />
      <div class="new-header1" v-else>
        <div class="text-ventonic-white mb-1">Negociaciones</div>

        <div class="col-12 header-ventonic mb-1">
          <!--
          <div class="mr-auto float-right bookmark-wrapper d-flex align-items-center">
            <ul class="list-inline m-0">
              <li class="list-inline-item controls">
                <a @click="returnList">
                  <i class="feather icon-arrow-left controls"></i>
                </a>
              </li>
            </ul>
          </div>
          -->
          <div class="row">
            <div class="col-3">
              <div class="search-results text-white my-1">
                <div class="avatar bg-primary mr-1">
                  <div class="avatar-content">
                    <i class="avatar-icon feather icon-bell text-white"></i>
                  </div>
                </div>
                Tiene {{ totalNegotiations }} negociaciones en total
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Lists View -->
      <section id="listView" class="row" v-if="getShowLists">
        <!-- Filters bar -->
        <negotiations-filters />
        <!-- Search and lists -->
        <!--<div id="searchAndListsCol" class="col-lg-auto d-none d-lg-block h-100">-->
        <div id="searchAndListsCol" class="col-lg-auto d-lg-block h-100">
          <div class="content-body">
            <div id="searchSection" class="row my-1 justify-content-center mb-0">
              <!-- Total of negotiations -->
              <div class="col-12 header-ventonic mb-0">
                <div class="row">
                  <div class="col-3">
                    <div class="search-results text-white my-1">
                      <div class="avatar bg-primary mr-1">
                        <div class="avatar-content">
                          <i class="avatar-icon feather icon-bell text-white"></i>
                        </div>
                      </div>
                      Tiene {{ totalNegotiations }} negociaciones en total
                    </div>
                  </div>
                  <!-- Search bar -->
                  <div class="col-5">
                    <form class="my-1">
                      <div class="form-group row mb-0">
                        <div class="col-md-8">
                          <fieldset
                            class="form-label-group form-group position-relative has-icon-left mb-0"
                          >
                            <input
                              type="text"
                              class="form-control"
                              id="searchbar"
                              placeholder="Buscar..."
                              v-model.trim="search"
                            />
                            <div class="form-control-position">
                              <i class="feather icon-search"></i>
                            </div>
                          </fieldset>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Filer badges -->

              <!-- Total of found negotiations 
              <div class="col-xs-12 col-lg-auto">
                <span>30 negociaciones encontradas</span>
              </div>
              -->
            </div>
            <!-- Lists -->
            <perfect-scrollbar class="ps-width">
              <div id="listsContainer" class="lists row p-1">
                <negotiations-list
                  class="list col-xs-12 col-sm-4 col-lg-2 mb-2"
                  style="margin-left:0"
                  v-for="(proc) in getProcesses"
                  :key="proc.id"
                  :process="proc"
                />
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
    draggable,
  },
  data() {
    return {
      window: {
        width: 0,
        height: 0,
      },
    };
  },
  props: [
    "types",
    "statuses",
    "processes",
    "negotiations",
    "user",
    "contacts",
    "a",
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
      setSearch: "SET_SEARCH",
    }),
    handleResize() {},
    updateModuleSizes() {},
    setFooterStyles() {},
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
      "getSearch",
    ]),
    search: {
      get() {
        return this.getSearch;
      },
      set(val) {
        this.setSearch(val);
      },
    },
    totalNegotiations() {
      return this.getNegotiations.length;
    },
  },
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

.neg_status {
  margin-top: -45px;
}
.ps-width {
  width: max-content;
}

.lists {
  display: flex;

  > .list {
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

  > * {
    background-color: $list-bg-color;
    color: #c2c6dc;

    /*padding: 0 $gap;*/
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

  .neg_content {
    padding: $gap;
  }

  .dragElements {
    list-style: none;
    margin: 0;

    li {
      /*background-color: #262c49 !important;*/
      background-color: #fff !important;
      /*padding: 10 10 0 10;*/

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

.badge-up1 {
  position: absolute;
  top: -0.1rem;
  right: 0.2rem;
}

@media (min-width: 992px) {
  body .content-detached.content-right .content-body {
    margin-left: calc(260px + 0.5rem) !important;
  }
}
</style>
