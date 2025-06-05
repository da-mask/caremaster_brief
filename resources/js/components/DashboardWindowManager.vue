<script setup lang="ts">
import { ref, markRaw, defineAsyncComponent } from 'vue';
import { type Company } from '@/types/caremaster';

const CompanyIndex      = defineAsyncComponent(() => import('./company/CompanyIndex.vue'));
const CompanyCreate     = defineAsyncComponent(() => import('./company/CompanyCreate.vue'));
const CompanyEdit       = defineAsyncComponent(() => import('./company/CompanyEdit.vue'));
const EmployeeCreate    = defineAsyncComponent(() => import('./employee/EmployeeCreate.vue'));

const props = defineProps<{ 
    companies?: Company[] 
}>();

const view = ref('index');
const selectedCompany = ref(null);

function showIndex() {
    view.value = 'index';
    selectedCompany.value = null;
}

function showCreate() {
    view.value = 'create';
}

function showEdit(company) {
    selectedCompany.value = company;
    view.value = 'edit';
}

function showEmployeeCreate(company) {
    selectedCompany.value = company;
    view.value = 'employee-create';
}

function handleDataChanged() {
    showIndex();
}
</script>

<template>
    <div class="flex flex-col gap-4">
        <CompanyIndex 
            v-if="view === 'index'" 
            :companies="companies" 
            @create="showCreate" 
            @edit="showEdit" 
        />
        
        <CompanyCreate 
            v-if="view === 'create'" 
            @cancel="showIndex" 
            @created="handleDataChanged" 
        />
        
        <CompanyEdit 
            v-if="view === 'edit'" 
            :company="selectedCompany" 
            @cancel="showIndex" 
            @updated="handleDataChanged" 
            @employee-create="showEmployeeCreate"
        />
        <EmployeeCreate 
            v-if="view === 'employee-create'" 
            :company="selectedCompany" 
            @cancel="showIndex" 
            @created="handleDataChanged" 
        />
    </div>
</template>
