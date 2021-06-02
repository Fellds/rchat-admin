<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Radios
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-2">
                        <radio-creation @created="created">
                            <jet-button type="button">
                                Create new Radio
                            </jet-button>
                        </radio-creation>
                    </div>

                    <table class="table-fixed w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20 text-right">#</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2 w-40 text-right">Frequency</th>
                                <th class="px-4 py-2 w-48">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="radio in radios" v-bind:key="radio.id">
                                <td class="border px-4 py-2 text-right">{{radio.id}}</td>
                                <td class="border px-4 py-2">{{radio.name}}</td>
                                <td class="border px-4 py-2 text-right">{{radio.frequency}}</td>
                                <td class="border px-4 py-2">
                                    <radio-editing @edited="edited" :radio_id="radio.id">
                                        <jet-button type="button">
                                            Edit
                                        </jet-button>
                                    </radio-editing>
                                    <radio-deletion @deleted="deleted" :radio_id="radio.id">
                                        <jet-danger-button class="ml-1" type="button">
                                            Delete
                                        </jet-danger-button>
                                    </radio-deletion>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import RadioCreation from '@/Components/Radio/RadioCreation'
    import RadioEditing from '@/Components/Radio/RadioEditing'
    import RadioDeletion from '@/Components/Radio/RadioDeletion'

    export default {
        props: {
            radios: Array,
        },

        components: {
            AppLayout,
            JetButton,
            JetDangerButton,
            RadioCreation,
            RadioEditing,
            RadioDeletion,
        },

        methods: {
            created(created) {
                this.radios.push(created)
            },

            edited(edited) {
                let index = this.radios.findIndex((radio => radio.id == edited.id));
                this.radios[index].name = edited.name
                this.radios[index].frequency = edited.frequency
                this.radios[index].logo = edited.logo
            },

            deleted(deleted) {
                let index = this.radios.findIndex((radio => radio.id == deleted.id));
                this.radios.splice(index, 1);
            }
        }
    }
</script>
