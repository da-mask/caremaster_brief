<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import { type Company, type Employee } from '@/types/caremaster';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { HeadingSmall } from '@/components/HeadingSmall.vue';

const props = defineProps<{ company: Company}>();

const emit = defineEmits(['cancel', 'updated', 'employee-create']);

const employees = ref([]);
const isLoadingEmployees = ref(false);

const form = useForm({
    name: props.company.name,
    abn: props.company.abn,
    email: props.company.email,
    address: props.company.address,
});

onMounted(async () => {
    isLoadingEmployees.value = true;
    try {
        const response = await fetch(route('companies.api.employees', props.company.id));
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const data = await response.json();
        employees.value = data;
    } catch (error) {
        console.error('Failed to load employees:', error);
    } finally {
        isLoadingEmployees.value = false;
    }
});

function handleSubmit() {
    form.put(route('companies.update', props.company.id), {
        onSuccess: () => {
            emit('updated');
        },
    });
}

function deleteEmployee(id) {
    router.delete(route('employees.destroy', id), {
        onSuccess: () => {
            emit('updated');
        },
    });
}

function handleCancel() {
    emit('cancel');
}

function handleEmployeeCreate() {
    emit('employee-create', props.company);
}
</script>

<template>
    <div class="space-y-4">
        <Card>
            <CardHeader>
                <CardTitle>Edit Company</CardTitle>
                <CardDescription>Update company information</CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="handleSubmit" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="grid gap-2">
                            <Label for="edit-name">Company Name</Label>
                            <Input id="edit-name" v-model="form.name" type="text" required />
                            <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="edit-abn">ABN</Label>
                            <Input id="edit-abn" v-model="form.abn" type="text" required />
                            <div v-if="form.errors.abn" class="text-red-500 text-sm">{{ form.errors.abn }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="edit-email">Email</Label>
                            <Input id="edit-email" v-model="form.email" type="email" required />
                            <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="edit-address">Address</Label>
                            <Input id="edit-address" v-model="form.address" type="text" required />
                            <div v-if="form.errors.address" class="text-red-500 text-sm">{{ form.errors.address }}</div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <Button @click="handleCancel" type="button" variant="outline">Cancel</Button>
                        <Button type="submit" :disabled="form.processing" variant="default">Update Company</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
        
        <Card>
            <CardHeader>
                <CardTitle>Employees</CardTitle>
                <CardDescription>Manage employees for this company</CardDescription>
            </CardHeader>
            <CardContent>
                <div v-if="isLoadingEmployees" class="text-center py-4">
                    Loading employees...
                </div>
                <div v-else>
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
                            <TableRow v-if="employees.length === 0">
                                <TableCell colspan="4" class="text-center py-4">No employees found for this company</TableCell>
                            </TableRow>
                            <TableRow v-for="employee in employees" :key="employee.id">
                                <TableCell>{{ employee.first_name }} {{ employee.last_name }}</TableCell>
                                <TableCell>{{ employee.email }}</TableCell>
                                <TableCell>{{ employee.phone }}</TableCell>
                                <TableCell>
                                    <Button @click="deleteEmployee(employee.id)" variant="destructive" size="sm">
                                        Delete
                                    </Button>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>                
                    <div class="mt-4">
                        <Button @click="handleEmployeeCreate()" variant="default">
                            Add Employee
                        </Button>
                    </div>
                </div>
            </CardContent>
        </Card>
    </div>
</template>
