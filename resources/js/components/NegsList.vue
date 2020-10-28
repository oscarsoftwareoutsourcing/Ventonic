<template>
  <div>
    <!-- Header -->
    <header class="d-flex w-100 justify-content-between headerList p-1 bg-gradient-primary">
      <a @click="toggleSort" style="text-decoration: none">
        {{ process.title }}
        <i
          class="fa ml-1"
          v-bind:class="{'fa-chevron-up':sort, 'fa-chevron-down':!sort}"
        ></i>
      </a>
      <span class="badge badge-pill badge-dark badge-up1">{{ negotiations.length }}</span>
    </header>

    <perfect-scrollbar>
      <ul class="dragElements p-0">
        <draggable group="negotiations" @add="onAdd($event, process.id)" :scroll-sensitivity="250">
          <negotiation-card
            v-for="(card, index) in negotiations"
            :key="index"
            :data-neg-id="card.id"
            :negotiation="card"
          />
        </draggable>
      </ul>
    </perfect-scrollbar>

    <!-- Imports SUM -->
    <footer class="footerList p-1 text-center">
      <h3 class="text-white">TOTAL: {{ sum }}</h3>
    </footer>
  </div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
export default {
  props: ["process"],
  data() {
    return {
      totalImports: 0,
      sort: false,
    };
  },
  methods: {
    ...mapActions(["changeToList"]),
    toggleSort() {
      this.sort = !this.sort;
    },
    async onAdd(event, id) {
      let values = {
        id: event.item.getAttribute("data-neg-id"),
        processId: id,
      };
      await this.changeToList(values);
    },
  },
  computed: {
    ...mapGetters(["getNegotiations", "getSearch", "getNegFilters"]),
    negotiations() {
      let arr = [];
      let total = 0;

      // Get base negotiations array,.
      if (this.getSearch !== "") {
        this.getNegotiations.filter((neg) => {
          if (
            neg.title.toLowerCase().includes(this.getSearch.toLowerCase()) &&
            neg.neg_process_id === this.process.id
          ) {
            arr.push(neg);
          }
        });
      } else {
        this.getNegotiations.filter((neg) => {
          if (neg.neg_process_id === this.process.id) {
            arr.push(neg);
          }
        });
      }

      // Filter array with filters criterias.
      // Active or archived negotiations
      if (this.getNegFilters.see !== null) {
        arr = arr.filter((neg) => {
          return neg.active === this.getNegFilters.see;
        });
      }
      // Negotiation owner
      if (this.getNegFilters.owner !== null) {
        arr = arr.filter((neg) => {
          return neg.owner.id === this.getNegFilters.owner;
        });
      }
      // Contact contact
      if (this.getNegFilters.contact !== null) {
        arr = arr.filter((neg) => {
          return neg.contact.id === this.getNegFilters.contact;
        });
      }
      // States
      if (this.getNegFilters.won === null) {
        arr = arr.filter((neg) => {
          return neg.status.id !== 1;
        });
      }
      if (this.getNegFilters.lost === null) {
        arr = arr.filter((neg) => {
          return neg.status.id !== 2;
        });
      }
      if (this.getNegFilters.inProcess === null) {
        arr = arr.filter((neg) => {
          return neg.status.id !== 3;
        });
      }
      // Dates
      if (this.getNegFilters.createdAt !== null) {
        arr = arr.filter((neg) => {
          return (
            neg.created_at.getTime() >= this.getNegFilters.from.getTime() &&
            neg.created_at.getTime() <= this.getNegFilters.to.getTime()
          );
        });
      }
      if (this.getNegFilters.deadline !== null) {
        arr = arr.filter((neg) => {
          return (
            neg.deadline.getTime() >= this.getNegFilters.from.getTime() &&
            neg.deadline.getTime() <= this.getNegFilters.to.getTime()
          );
        });
      }
      // Imports
      if (this.getNegFilters.equals) {
        arr = arr.filter((neg) => {
          return neg.amount == this.getNegFilters.fromAmount;
        });
      }
      if (this.getNegFilters.bigger) {
        arr = arr.filter((neg) => {
          return (
            parseFloat(neg.amount) >= parseFloat(this.getNegFilters.fromAmount)
          );
        });
      }
      if (this.getNegFilters.lower) {
        arr = arr.filter((neg) => {
          return (
            parseFloat(neg.amount) <= parseFloat(this.getNegFilters.fromAmount)
          );
        });
      }
      if (this.getNegFilters.range) {
        arr = arr.filter((neg) => {
          return (
            parseFloat(neg.amount) >=
              parseFloat(this.getNegFilters.fromAmount) &&
            parseFloat(neg.amount) <= parseFloat(this.getNegFilters.toAmount)
          );
        });
      }

      // Calculate totals.
      arr.forEach((element) => {
        total += element.amount;
      });

      this.totalImports = total;

      // Date sorting
      if (this.sort) {
        // Asc
        arr = arr.sort((a, b) => a.created_at - b.created_at);
      } else {
        // Desc
        arr = arr.sort((a, b) => b.created_at - a.created_at);
      }

      return arr;
    },
    sum() {
      return new Intl.NumberFormat("de-ES", {
        style: "currency",
        currency: "EUR",
      }).format(this.totalImports);
    },
  },
};
</script>

<style lang="scss">
</style>
