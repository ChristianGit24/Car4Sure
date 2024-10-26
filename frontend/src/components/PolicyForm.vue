<template>
  <div class="form-container">
    <form @submit.prevent="handleSubmit" class="flex flex-col gap-4">
      <div class="field">
        <label for="policy_no">Policy Number*</label>
        <InputText id="policy_no" v-model="formData.policy_no" required />
      </div>

      <div class="field">
        <label for="type">Policy Type*</label>
        <Dropdown
          id="type"
          v-model="formData.type"
          :options="['Auto', 'Home', 'Life']"
          placeholder="Select Type"
          required
        />
      </div>

      <div class="field">
        <label for="status">Status*</label>
        <Dropdown
          id="status"
          v-model="formData.status"
          :options="['Active', 'Pending', 'Cancelled']"
          placeholder="Select Status"
          required
        />
      </div>

      <div class="field">
        <label for="effective_date">Effective Date*</label>
        <Calendar
          id="effective_date"
          v-model="formData.effective_date"
          dateFormat="yy-mm-dd"
          required
        />
      </div>

      <div class="field">
        <label for="expiration_date">Expiration Date*</label>
        <Calendar
          id="expiration_date"
          v-model="formData.expiration_date"
          dateFormat="yy-mm-dd"
          required
        />
      </div>

      <div class="field">
        <label for="policy_holder_id">Policy Holder*</label>
        <Dropdown
          id="policy_holder_id"
          v-model="formData.policy_holder_id"
          :options="policyHolders"
          optionLabel="fullName"
          optionValue="id"
          placeholder="Select Policy Holder"
          required
        />
      </div>

      <div class="flex justify-end gap-2">
        <Button
          type="button"
          label="Cancel"
          @click="handleCancel"
          class="p-button-danger"
        />
        <Button type="submit" label="Save" class="p-button-primary" />
      </div>
    </form>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import api from "../services/api";
import { useToast } from "primevue/usetoast";

export default {
  name: "PolicyForm",
  props: {
    policy: {
      type: Object,
      default: null,
    },
  },
  emits: ["save", "cancel"],
  setup(props, { emit }) {
    const toast = useToast();
    const formData = ref({
      policy_no: "",
      type: "",
      status: "",
      effective_date: null,
      expiration_date: null,
      policy_holder_id: null,
    });

    const policyHolders = ref([]);

    const loadPolicyHolders = async () => {
      try {
        const response = await api.get("/policy-holders");
        policyHolders.value = response.data.map((holder) => ({
          ...holder,
          fullName: `${holder.first_name} ${holder.last_name}`,
        }));
      } catch (error) {
        console.error("Error loading policy holders:", error);
        toast.add({
          severity: "error",
          summary: "Error",
          detail: "Failed to load policy holders.",
          life: 3000,
        });
      }
    };

    onMounted(async () => {
      await loadPolicyHolders();

      if (props.policy) {
        formData.value = {
          ...props.policy,
          effective_date: new Date(props.policy.effective_date),
          expiration_date: new Date(props.policy.expiration_date),
        };
      }
    });

    const handleSubmit = async () => {
      try {
        const formattedData = {
          ...formData.value,
          effective_date: formData.value.effective_date
            .toISOString()
            .split("T")[0],
          expiration_date: formData.value.expiration_date
            .toISOString()
            .split("T")[0],
        };

        emit("save", formattedData);
        toast.add({
          severity: "success",
          summary: props.policy ? "Policy Updated" : "New Policy Created",
          detail: props.policy
            ? "Policy updated successfully."
            : "Policy created successfully.",
          life: 3000,
        });
      } catch (error) {
        console.error("Form submission error:", error);
        toast.add({
          severity: "error",
          summary: "Error",
          detail: "Failed to save policy.",
          life: 3000,
        });
      }
    };

    const handleCancel = () => {
      emit("cancel");
      toast.add({
        severity: "info",
        summary: "Cancelled",
        detail: props.policy
          ? "Policy edit cancelled."
          : "New policy creation cancelled.",
        life: 3000,
      });
    };

    return {
      formData,
      policyHolders,
      handleSubmit,
      handleCancel,
    };
  },
};
</script>

<style scoped>
.form-container {
  max-width: 700px;
  padding: 2rem;
  background-color: #f9fafb;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
}

.field {
  margin-bottom: 1rem;
}

.field label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
}

.field input,
.field .p-dropdown,
.field .p-calendar {
  width: 100%;
  padding: 0.75rem;
  border-radius: 4px;
  border: 1px solid #d1d5db;
}

.flex {
  margin-top: 1.5rem;
  display: flex;
  gap: 1rem;
  justify-content: flex-end;
}

.flex .p-button-primary,
.flex .p-button-danger {
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  border-radius: 6px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.flex .p-button-primary {
  background-color: #4f46e5;
  color: #fff;
}

.flex .p-button-danger {
  background-color: #ff0000;
  color: #fff;
}

.flex .p-button-primary:hover {
  background-color: #4338ca;
}

.flex .p-button-danger:hover {
  background-color: #dd0f0f;
}
</style>
