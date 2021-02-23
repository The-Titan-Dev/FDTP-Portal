<template>
  <b-container fluid>
    <b-row class="justify-content-center">
      <b-col>
        <div class="page__body">
          <div class="page__title mb-4">USER MANAGEMENT</div>
          <b-row>
            <b-col>
              <div class="table__container">
                <b-row>
                  <b-col xl="2" lg="2" md="4">
                    <b-form-group
                      id="input-group-2"
                      label="Select display row"
                      label-for="per-page-select"
                      description="Displayed row base on selection"
                      class="filter__group"
                    >
                      <b-form-select
                        id="per-page-select"
                        v-model="perPage"
                        :options="pageOptions"
                        size="sm"
                        class="custom__input"
                      ></b-form-select>
                    </b-form-group>
                  </b-col>
                  <b-col xl="4" lg="4" md="8">
                    <b-form-group
                      id="input-group-1"
                      label="Search Keyword:"
                      label-for="filter-input"
                      description="What are you looking for?"
                      class="filter__group"
                    >
                      <b-form-input
                        id="filter-input"
                        v-model="filter"
                        type="search"
                        class="custom__input"
                      >
                      </b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col cols="12">
                    <b-table
                      id="budgets_table"
                      class="custom__table"
                      hover
                      bordered
                      responsive
                      :fields="fields"
                      :filter="filter"
                      :filter-included-fields="filterOn"
                      :items="this.getUsers.data"
                      :per-page="perPage"
                      :current-page="currentPage"
                    >
                      <template #cell(emp_photo)="data">
                        <center>
                          <b-avatar :src="`/${data.item.emp_photo}`" size="60px"></b-avatar>
                        </center>
                      </template>

                      <template #cell(name)="data">
                        <label>
                          {{ data.item.emp_first_name}}
                          {{ data.item.emp_middle_name}}
                          {{ data.item.emp_last_name }}
                        </label>
                      </template>
                    </b-table>
                  </b-col>

                  <b-col class="d-flex justify-content-center mt-3">
                    <b-pagination
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
                      class="custom__pagination"
                    >
                      <template #first-text><span>First</span></template>
                      <template #prev-text><span>Prev</span></template>
                      <template #next-text><span>Next</span></template>
                      <template #last-text><span>Last</span></template>
                      <template #ellipsis-text>
                        <b-spinner small type="grow"></b-spinner>
                        <b-spinner small type="grow"></b-spinner>
                        <b-spinner small type="grow"></b-spinner>
                      </template>
                      <template #page="{ page, active }">
                        <b v-if="active">{{ page }}</b>
                        <i v-else>{{ page }}</i>
                      </template>
                    </b-pagination>
                  </b-col>
                </b-row>
              </div>
            </b-col>
          </b-row>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template> 

<script>
import Case from "../components/Case.vue";
import { mapGetters } from "vuex";
export default {
  name: "UserManagement",
  components: {
    Case,
  },
  data() {
    return {
      fields: [
        { key: "emp_id", sortable: true },
        { key: "emp_photo", sortable: true, label: "Image" },
        { key: "name", sortable: true, label: "Employee" },
        { key: "position", sortable: true },
        { key: "section", sortable: true },
      ],
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15, { value: 100, text: "Show more" }],
      filter: null,
      filterOn: [],
    };
  },
  mounted() {
    this.load_users();
  },
  computed: {
    ...mapGetters(["getUsers"]),
    rows() {
      if (!this.getUsers.data) {
        return 1;
      } else {
        return this.getUsers.data.length;
      }
    },
  },
  methods: {
    load_users: function () {
      this.$store.dispatch("loadUsers").then((result) => {
        this.toast(result.status, result.message);
      });
    },
    toast: function (status, message) {
      this.$toast(message, {
        type: status,
        toastClassName: `toastification--${status}`,
        position: "top-center",
      });
    },
  },
};
</script>

<style lang="scss">
@import "../../sass/variables";
@import "../../sass/mediascreens";

.page__body {
  width: 100%;
  height: auto;
  margin-top: 120px;
  padding-left: 15px;
  padding-right: 15px;
}

.page__title {
  width: 400px;
  font-size: 40px;
  border-bottom: 5px solid $red;
  color: $black;
}

.table__container {
  .filter__group {
    width: auto;
    background: white;
    padding: 10px 25px 10px 25px;
    border-radius: 10px;
    box-shadow: 10px 8px 13px #c6c9ca;
    margin-bottom: 20px;
  }

  .custom__input {
    height: 40px;
  }

  .custom__table {
    background: white;
    border-radius: 10px;
    box-shadow: 10px 8px 13px #c6c9ca;
    td {
      border: 0;
      color: $black;
      padding: 10px 20px 10px 20px;
      border-bottom: 1px solid #efefef;
      font-family: MontserratRegular;
    }

    th {
      border: 0;
      color: $black;
      border-bottom: 2px solid #eaeaea;
      padding: 20px 30px 20px 30px;
      font-family: MontserratBold;
    }
  }

  .custom__pagination {
    .page-item {
      .page-link {
        color: $black;
      }
    }

    .page-item.disabled {
      .page-link {
        color: #b2b5b5;
      }
    }

    .page-item.active {
      .page-link {
        color: white;
        background: $red;
        border-color: $red;
        outline-color: $red;
      }
    }
  }
}
</style>