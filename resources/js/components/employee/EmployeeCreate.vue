<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';

const emit = defineEmits(['cancel', 'created']);

const props = defineProps<{ 
    company: Company
}>();

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    company_id: props.company.id,
});

function handleSubmit() {
    form.post(route('employees.store'), {
        onSuccess: () => {
            emit('created');
        },
    });
}

function handleCancel() {
    emit('cancel');
}
</script>

<template>
    <div class="w-full">
        <Card>
            <CardHeader>
                <CardTitle>Create Employee</CardTitle>
                <CardDescription>Add a new employee to the system</CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="handleSubmit" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="grid gap-2">
                            <Label for="first_name">First Name</Label>
                            <Input id="first_name" v-model="form.first_name" type="text" required />
                            <div v-if="form.errors.first_name" class="text-red-500 text-sm">{{ form.errors.first_name }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="last_name">Last Name</Label>
                            <Input id="last_name" v-model="form.last_name" type="text" required />
                            <div v-if="form.errors.last_name" class="text-red-500 text-sm">{{ form.errors.last_name }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input id="email" v-model="form.email" type="email" required />
                            <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="phone">Phone</Label>
                            <Input id="phone" v-model="form.phone" type="text" required />
                            <div v-if="form.errors.phone" class="text-red-500 text-sm">{{ form.errors.phone }}</div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <Button @click="handleCancel" type="button" variant="outline">Cancel</Button>
                        <Button type="submit" :disabled="form.processing" variant="default">Create Employee</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>