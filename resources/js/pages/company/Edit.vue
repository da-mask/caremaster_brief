<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import HeadingSmall from '@/components/HeadingSmall.vue';
    import InputError from '@/components/InputError.vue';
    import { Input } from '@/components/ui/input'
    import { Label } from '@/components/ui/label'
    import { Button } from '@/components/ui/button'
    import { 
        Table,
        TableBody,
        TableCaption,
        TableCell,
        TableHead,
        TableHeader,
        TableRow,
    } from '@/components/ui/table'
    import { type BreadcrumbItem } from '@/types';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { type Company, type Employee } from '@/types/caremaster';
    
    const props = defineProps<{ 
        company: Company,
        employees: Employee[]
    }>();

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Companies',
            href: route('companies.index'),
        },
        {
            title: 'Edit',
            href: route('companies.edit', props.company.id),
        }
    ];
    const form = useForm<Company>({
        name: props.company.name,
        abn: props.company.abn,
        email: props.company.email,
        address: props.company.address,
    });
    
    const submit = () => {
        form.put(route('companies.update', props.company.id));
    };
</script>

<template>
    <Head title="Edit Company" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="grid gap-4">
                    <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                        <HeadingSmall title="Edit Company" description="Update the company details below and click Update Company to save changes" class="mb-6"/>
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <Label for="name">
                                    Name
                                    <Input id="name" v-model="form.name" type="text" />
                                    <InputError :message="form.errors.name" />
                                </Label>
                                <Label for="abn">
                                    ABN
                                    <Input id="abn" v-model="form.abn" type="text" />
                                    <InputError :message="form.errors.abn" />
                                </Label>
                                <Label for="email">
                                    Email
                                    <Input id="email" v-model="form.email" type="email" />
                                    <InputError :message="form.errors.email" />
                                </Label>
                                <Label for="address">
                                    Address
                                    <Input id="address" v-model="form.address" type="text" />
                                    <InputError :message="form.errors.address" />
                                </Label>
                            </div>
                            <div class="flex my-6 gap-4">
                                <Button type="submit">
                                    Update Company
                                </Button>
                                <Button as-child variant="secondary" type="button">
                                    <Link :href="route('employees.create',{company_id: company.id})">
                                        Add Employee
                                    </Link>
                                </Button>
                            </div>
                        </form>
                    </div>     
             
                    <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                       <HeadingSmall title="Employees" description="List of employees for this company" class="mb-6"/>
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Email</TableHead>
                                    <TableHead>Phone</TableHead>
                                    <TableHead>Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow v-for="employee in employees" :key="employee.id">
                                    <TableCell>{{ employee.first_name }} {{ employee.last_name }}</TableCell>
                                    <TableCell>{{ employee.email }}</TableCell>
                                    <TableCell>{{ employee.phone }}</TableCell>
                                    <TableCell>
                                        <Button as-child variant="destructive">
                                            <Link :href="route('employees.destroy', employee.id)" method="delete">
                                                Delete
                                            </Link>
                                        </Button>
                                    </TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>