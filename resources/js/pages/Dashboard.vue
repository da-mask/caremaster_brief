<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head } from '@inertiajs/vue3';
    import DashboardCounter from '../components/DashboardCounter.vue';
    import DashboardWindowManager from '../components/DashboardWindowManager.vue';
    import { computed, ref } from 'vue';
   
    const props = defineProps<{ 
        companies: Company[] 
    }>();

    const company_count = computed(() => props.companies.length || 0);
    const employee_count = computed(() => props.companies.reduce((total, company) => total + company.employees_count, 0));
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <DashboardCounter 
                        title="Total Companies" 
                        description="Total number of companies in the system" 
                        :count="company_count"
                        />
                </div>
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <DashboardCounter 
                        title="Total Employees" 
                        description="Total number of employees in the system" 
                        :count="employee_count"
                        />
                </div>
            </div>
            <div class="relative flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4 md:min-h-min">
                <DashboardWindowManager :companies="companies" />
            </div>
        </div>
    </AppLayout>
</template>
