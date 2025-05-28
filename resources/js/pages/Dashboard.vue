<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head } from '@inertiajs/vue3';
    import PlaceholderPattern from '../components/PlaceholderPattern.vue';
    import DashboardCounter from '../components/DashboardCounter.vue';
    import { type Company } from '@/types/carmaster';

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
    ];
    defineProps<{ 
        companies?: Company[] 
        employees?: Employee[] 
    }>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <DashboardCounter 
                        title="Total Companies" 
                        description="Total number of companies in the system" 
                        :count= companies.length
                        />
                </div>
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <DashboardCounter 
                        title="Total Employees" 
                        description="Total number of employees in the system" 
                        :count= employees.length
                        />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
