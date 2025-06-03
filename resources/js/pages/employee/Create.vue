<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import HeadingSmall from '@/components/HeadingSmall.vue';
    import InputError from '@/components/InputError.vue';

    import { type BreadcrumbItem } from '@/types';
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import { Input } from '@/components/ui/input'
    import { Label } from '@/components/ui/label'
    import { Button } from '@/components/ui/button'
    import { type Employee } from '@/types/caremaster';
    
    const props = defineProps<{ 
        company_id: number
    }>();
    
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Companies',
            href: route('companies.index'),
        },
        {
            title: 'Company',
          
        }
    ];
    
    const form = useForm<Employee>({
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        company_id: props.company_id,
    });

    const submit = () => {
        form.post(route('employees.store'));
    };
</script>

<template>
    <Head title="Create Employee" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 text-2xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <HeadingSmall title="Create Employee" class="mb-6" />
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid gap-2">
                            <Label for="first_name">First Name</Label>
                            <Input
                                id="first_name"
                                ref="first_nameInput"
                                v-model="form.first_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="name"
                                placeholder="Employee Name"
                            />
                            <InputError :message="form.errors.first_name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="last_name">Last Name</Label>
                            <Input
                                id="last_name"
                                ref="last_nameInput"
                                v-model="form.last_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="email"
                                placeholder="Employee Email"
                            />
                            <InputError :message="form.errors.last_name" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                ref="emailInput"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                autocomplete="email"
                                placeholder="Employee Email"
                            />
                            <InputError :message="form.errors.email" />
                        </div>
                        <div class="grid gap-2">
                            <label for="phone">Phone</label>
                            <Input
                                id="phone"
                                ref="phoneInput"
                                v-model="form.phone"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="address"
                                placeholder="Employee Phone"
                            />
                            <InputError :message="form.errors.phone" />
                        </div>
                        <div class="flex items-center gap-4">
                            <Button :disabled="form.processing">Save employee</Button>
                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-show="form.recentlySuccessful" class="text-sm text-neutral-600">Saved.</p>
                            </Transition>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AppLayout> 
</template>