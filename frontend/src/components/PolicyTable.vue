<template>
  <div class="p-4">
    <Toast ref="toast" />
    <ConfirmDialog />

    <DataTable
      :value="tableData"
      v-model:selection="selectedPolicies"
      dataKey="id"
      class="p-4 border border-gray-300 rounded-md shadow-md"
      tableStyle="min-width: 100%;"
      stripedRows
      size="large"
    >
      <h4 class="mb-3 text-3xl font-bold p-2" style="color: #f97316">
        Manage Policies
      </h4>

      <Toolbar class="mb-2">
        <template #start>
          <Button
            label="New Policy"
            @click="openModal()"
            class="p-button-success mr-2"
          />
          <Button
            label="Delete Selected"
            @click="confirmDeleteSelectedPolicies"
            class="p-button-danger"
            :disabled="!selectedPolicies || !selectedPolicies.length"
          />
        </template>
      </Toolbar>

      <Column selectionMode="multiple" headerStyle="width: 3em"></Column>

      <Column
        field="policy_no"
        header="Policy No."
        sortable
        style="width: 15%"
      ></Column>
      <Column header="Policy Holder" sortable style="width: 20%">
        <template #body="slotProps">
          {{ slotProps.data.policy_holder.first_name }}
          {{ slotProps.data.policy_holder.last_name }}
        </template>
      </Column>
      <Column field="type" header="Type" sortable style="width: 15%"></Column>
      <Column
        field="status"
        header="Status"
        sortable
        style="width: 15%"
      ></Column>
      <Column
        field="effective_date"
        header="Effective Date"
        sortable
        style="width: 15%"
      >
        <template #body="slotProps">
          {{
            slotProps.data.effective_date
              ? new Date(slotProps.data.effective_date).toLocaleDateString()
              : "No Date"
          }}
        </template>
      </Column>

      <Column header="Action" style="width: 20%">
        <template #body="slotProps">
          <Button
            icon="pi pi-pencil"
            @click="openModal(slotProps.data)"
            class="p-button-sm p-button-info mr-2"
          />
          <Button
            icon="pi pi-trash"
            @click="confirmDeletePolicy(slotProps.data.id)"
            class="p-button-sm p-button-danger"
          />
        </template>
      </Column>
    </DataTable>

    <Dialog
      :visible="isModalOpen"
      @hide="closeModal"
      :modal="true"
      :closable="false"
      :dismissable="false"
      header="Create Policy"
      :style="{ width: '70vw', maxWidth: '900px' }"
    >
      <PolicyForm
        :policy="selectedPolicy"
        @save="savePolicy"
        @cancel="closeModal"
      />
    </Dialog>
  </div>
</template>

<script>
import Toolbar from "primevue/toolbar";
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Dialog from "primevue/dialog";
import ConfirmDialog from "primevue/confirmdialog";
import Toast from "primevue/toast";
import PolicyForm from "./PolicyForm.vue";
import api from "../services/api";
import { useToast } from "primevue/usetoast";
import { useConfirm } from "primevue/useconfirm";

export default {
  name: "PolicyTable",
  components: {
    Toolbar,
    Button,
    DataTable,
    Column,
    Dialog,
    PolicyForm,
    ConfirmDialog,
    Toast,
  },
  setup() {
    const toast = useToast();
    const confirm = useConfirm();

    return {
      toast,
      confirm,
    };
  },
  data() {
    return {
      tableData: [],
      selectedPolicies: null,
      isModalOpen: false,
      selectedPolicy: null,
    };
  },
  methods: {
    async fetchPolicies() {
      try {
        const response = await api.get("/policies");
        this.tableData = response.data;
      } catch (error) {
        console.error("Error fetching policies:", error);
        this.toast.add({
          severity: "error",
          summary: "Error",
          detail: "Failed to fetch policies.",
          life: 3000,
        });
      }
    },
    openModal(policy = null) {
      this.selectedPolicy = policy ? { ...policy } : null;
      this.isModalOpen = true;
    },
    closeModal() {
      this.selectedPolicy = null;
      this.isModalOpen = false;
    },
    async savePolicy(policy) {
      try {
        if (policy.id) {
          await api.put(`/policies/${policy.id}`, policy);
        } else {
          await api.post("/policies", policy);
          this.toast.add({
            severity: "success",
            summary: "Policy Created",
            detail: "New policy created successfully.",
            life: 3000,
          });
        }
        this.fetchPolicies();
        this.closeModal();
      } catch (error) {
        console.error("Error saving policy:", error);
        this.toast.add({
          severity: "error",
          summary: "Save Error",
          detail: "Failed to save policy.",
          life: 3000,
        });
      }
    },
    confirmDeletePolicy(policyId) {
      this.confirm.require({
        message: "Are you sure you want to delete this policy?",
        header: "Confirmation",
        icon: "pi pi-exclamation-triangle",
        acceptLabel: "Yes",
        rejectLabel: "No",
        acceptClass: "custom-accept-button",
        rejectClass: "custom-reject-button",
        accept: () => this.deletePolicy(policyId),
      });
    },
    async deletePolicy(policyId) {
      try {
        await api.delete(`/policies/${policyId}`);
        this.fetchPolicies();
        this.toast.add({
          severity: "success",
          summary: "Policy Deleted",
          detail: "Policy deleted successfully.",
          life: 3000,
        });
      } catch (error) {
        console.error("Error deleting policy:", error);
        this.toast.add({
          severity: "error",
          summary: "Delete Error",
          detail: "Failed to delete policy.",
          life: 3000,
        });
      }
    },
    confirmDeleteSelectedPolicies() {
      this.confirm.require({
        message: "Are you sure you want to delete the selected policies?",
        header: "Confirmation",
        icon: "pi pi-exclamation-triangle",
        acceptLabel: "Yes",
        rejectLabel: "No",
        acceptClass: "custom-accept-button",
        rejectClass: "custom-reject-button",
        accept: () => this.deleteSelectedPolicies(),
      });
    },
    async deleteSelectedPolicies() {
      try {
        await Promise.all(
          this.selectedPolicies.map((policy) =>
            api.delete(`/policies/${policy.id}`)
          )
        );
        this.selectedPolicies = null;
        this.fetchPolicies();
        this.toast.add({
          severity: "success",
          summary: "Policies Deleted",
          detail: "Selected policies deleted successfully.",
          life: 3000,
        });
      } catch (error) {
        console.error("Error deleting selected policies:", error);
        this.toast.add({
          severity: "error",
          summary: "Delete Error",
          detail: "Failed to delete selected policies.",
          life: 3000,
        });
      }
    },
  },
  mounted() {
    this.fetchPolicies();
  },
};
</script>

<style>
@import "primevue/resources/themes/lara-light-blue/theme.css";
@import "primevue/resources/primevue.css";
@import "primeicons/primeicons.css";
@import "primeflex/primeflex.css";
</style>
