<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    registration_number: '',
    admin_name: '',
    admin_email: '',
    admin_password: '',
});

const submit = () => {
    form.post(route('tenants.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Create Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Company</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="name" value="Company Name" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="registration_number" value="Registration Number" />
                            <TextInput id="registration_number" type="text" class="mt-1 block w-full" v-model="form.registration_number" />
                            <InputError class="mt-2" :message="form.errors.registration_number" />
                        </div>

                        <hr class="my-6">

                        <div>
                            <InputLabel for="admin_name" value="Admin Name" />
                            <TextInput id="admin_name" type="text" class="mt-1 block w-full" v-model="form.admin_name" required />
                            <InputError class="mt-2" :message="form.errors.admin_name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="admin_email" value="Admin Email" />
                            <TextInput id="admin_email" type="email" class="mt-1 block w-full" v-model="form.admin_email" required />
                            <InputError class="mt-2" :message="form.errors.admin_email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="admin_password" value="Admin Password" />
                            <TextInput id="admin_password" type="password" class="mt-1 block w-full" v-model="form.admin_password" required />
                            <InputError class="mt-2" :message="form.errors.admin_password" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create Company
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>