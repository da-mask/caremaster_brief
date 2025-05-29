<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { type Company } from '@/types/caremaster';
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Companies',
            href: route('companies.index'),
        },
        {
            title: 'Edit',
            href: route('companies.edit', props.id),
        }
    ];
</script>

<template>
    
</template>