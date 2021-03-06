<template>
  <div>
    <div class="container pt-5">
      <div class="row ">
        <h5 class="">Organization Section</h5>
        <p class="text-muted">
          Manage the organization offered by the university
        </p>
        <div class="col-12 col-sm-11 col-md-12 col-lg-11 col-xl-11 mt-4">
          <div class="card p-5">
            <div class="d-flex justify-content-end">
              <button
                class="btn btn-primary"
                v-on:click.prevent="$bvModal.show('addOrganizationModal')"
              >
                <i class="bi bi-node-plus me-2"></i>Organization
              </button>
            </div>
            <b-skeleton-table
              :rows="6"
              :columns="5"
              :table-props="{ bordered: true, striped: true }"
              class="mt-4"
              v-if="initialLoading"
            ></b-skeleton-table>
            <div class="table-responsive mt-4" v-else>
              <table class="table table-striped table-hover">
                <caption>
                  Showing
                  {{
                    organizations.from
                  }}
                  to
                  {{
                    organizations.to
                  }}
                  out of
                  {{
                    organizations.total
                  }}
                  data
                </caption>
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">College</th>
                    <th
                      class="cursor-pointer"
                      v-on:click.prevent="sort = sort == 'asc' ? 'desc' : 'asc'"
                    >
                      Organization
                      <i
                        class="bi"
                        :class="
                          sort == 'asc'
                            ? 'bi-arrow-up-short'
                            : 'bi-arrow-down-short'
                        "
                      ></i>
                    </th>
                    <th scope="col">Abbreviation</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(org, i) in organizations.data" :key="i">
                    <td scope="row">{{ i + organizations.from }}</td>
                    <td>{{ org.college.college }}</td>
                    <td>{{ org.organization }}</td>
                    <td>{{ org.abbreviation }}</td>
                    <td>
                      <div class="d-flex">
                        <a
                          v-on:click.prevent="
                            data = JSON.parse(JSON.stringify(org));
                            $bvModal.show('updateOrganizationModal');
                          "
                          href=""
                          class="btn btn-primary btn-sm me-1 rounded-pill"
                          ><i class="bi bi-pencil"></i
                        ></a>
                        <a
                          v-on:click.prevent="
                            delete_data.id = org.id;
                            $bvModal.show('deleteOrganizationModal');
                          "
                          href=""
                          class="btn btn-danger btn-sm rounded-pill"
                          ><i class="bi bi-trash"></i
                        ></a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="row mt-3" v-if="organizations.data">
                <pagination
                  :showDisabled="true"
                  :align="'right'"
                  :data="organizations"
                  @pagination-change-page="getOrganizations"
                >
                  <span slot="prev-nav">&laquo;</span>
                  <span slot="next-nav">&raquo;</span>
                </pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <b-modal id="addOrganizationModal" centered title="Add Organization">
      <div class="row pe-4 ps-4 pt-1 pb-2">
        <div class="col">
          <label class="mt-2" for="item">College</label>
          <select v-model="data.college_id" class="form-select">
            <option :value="c.id" v-for="(c, i) in allcolleges" :key="i">{{
              c.college
            }}</option>
          </select>
          <label class="mt-2" for="remarks">Organization</label>
          <input
            v-model="data.organization"
            id="remarks"
            type="text"
            class="form-control"
            placeholder=""
            aria-label="Middle Name"
          />
          <label class="mt-2" for="remarks"
            >Abbreviation <small>(Optional)</small></label
          >
          <input
            v-model="data.abbreviation"
            id="remarks"
            type="text"
            class="form-control"
            placeholder=""
            aria-label="Middle Name"
          />
        </div>
      </div>
      <template #modal-footer="{cancel}">
        <b-button
          variant="primary"
          size="sm"
          @click="cancel()"
          :disabled="isLoading"
        >
          Cancel
        </b-button>
        <b-button
          variant="success"
          size="sm"
          v-on:click.prevent="saveOrganization"
          :disabled="isLoading"
        >
          Save
        </b-button>
      </template>
    </b-modal>

    <b-modal id="updateOrganizationModal" centered title="Update Organization">
      <div class="row pe-4 ps-4 pt-1 pb-2">
        <div class="col">
          <label class="mt-2" for="item">College</label>
          <input
            v-model="data.college.college"
            id="item"
            type="text"
            class="form-control"
            placeholder=""
            aria-label="First Name"
            disabled
            readonly
          />
          <label class="mt-2" for="remarks">Organization</label>
          <input
            v-model="data.organization"
            id="remarks"
            type="text"
            class="form-control"
            placeholder=""
            aria-label="Middle Name"
          />
          <label class="mt-2" for="remarks"
            >Abbreviation <small>(Optional)</small></label
          >
          <input
            v-model="data.abbreviation"
            id="remarks"
            type="text"
            class="form-control"
            placeholder=""
            aria-label="Middle Name"
          />
        </div>
      </div>
      <template #modal-footer="{cancel}">
        <b-button
          variant="primary"
          size="sm"
          @click="cancel()"
          :disabled="isLoading"
        >
          Cancel
        </b-button>
        <b-button
          variant="success"
          size="sm"
          v-on:click.prevent="updateOrganization"
          :disabled="isLoading"
        >
          Update
        </b-button>
      </template>
    </b-modal>

    <b-modal id="deleteOrganizationModal" centered title="Confirm Delete">
      <p>Are you sure you want to delete this organization?</p>
      <template #modal-footer="{cancel}">
        <b-button
          variant="primary"
          size="sm"
          @click="cancel()"
          :disabled="isLoading"
        >
          Cancel
        </b-button>
        <b-button
          variant="success"
          size="sm"
          v-on:click.prevent="deleteOrganization"
          :disabled="isLoading"
        >
          Delete
        </b-button>
      </template>
    </b-modal>
  </div>
</template>
<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      data: {
        college_id: "",
        organization: "",
        abbreviation: "",
        college: {},
      },
      delete_data: {
        id: "",
      },
      sort: "asc",
    };
  },
  async mounted() {
    this.initialLoading = true;
    await this.$store.dispatch("auth/checkAdminUser");
    await this.$store.dispatch("college/allColleges");
    this.getOrganizations();
    console.clear();
    this.$root.$on("bv::modal::show", (modalId) => {
      this.modalId = modalId.componentId;
    });
    this.$root.$on("bv::modal::hide", (modalId) => {
      this.data.college_id = "";
      this.data.organization = "";
      this.data.abbreviation = "";
    });
    this.initialLoading = false;
  },
  computed: {
    ...mapState("college", ["allcolleges"]),
    ...mapState("organizations", ["organizations"]),
  },
  methods: {
    async getOrganizations(page = 1) {
      await this.$store.dispatch("organizations/getOrganizations", {
        page: page,
        sort: this.sort,
      });
    },
    async saveOrganization() {
      if (this.data.organization.trim() == "")
        return this.$toast.error("Organization name is required");
      if (this.data.college_id == "")
        return this.$toast.error("College is required");

      this.isLoading = true;
      const { data, status } = await this.$store.dispatch(
        "organizations/saveOrganization",
        this.data
      );
      this.checkStatus(data, status, "", "organizations/getOrganizations");
    },
    async updateOrganization() {
      if (this.data.organization.trim() == "")
        return this.$toast.error("Organization name is required");
      if (this.data.college_id == "")
        return this.$toast.error("College is required");

      this.isLoading = true;
      const { data, status } = await this.$store.dispatch(
        "organizations/updateOrganization",
        this.data
      );
      this.checkStatus(data, status, "update");
    },
    async deleteOrganization() {
      this.isLoading = true;
      const { data, status } = await this.$store.dispatch(
        "organizations/deleteOrganization",
        this.delete_data
      );
      this.checkStatus(data, status, "", "organizations/getOrganizations");
    },
    closeModal() {
      this.$bvModal.hide(this.modalId);
    },
  },
  watch: {
    sort() {
      this.getOrganizations();
    },
  },
};
</script>
