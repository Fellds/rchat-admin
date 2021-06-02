<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Channels
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-2">
                        <channel-creation @created="created">
                            <jet-button type="button">
                                Create new Channel
                            </jet-button>
                        </channel-creation>
                    </div>

                    <table class="table-fixed w-full text-left">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-20 text-right">#</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Radio</th>
                                <th class="px-4 py-2 w-48">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="channel in channels" v-bind:key="channel.id">
                                <td class="border px-4 py-2 text-right">{{channel.id}}</td>
                                <td class="border px-4 py-2">{{channel.name}}</td>
                                <td class="border px-4 py-2">{{channel.radio_id}}</td>
                                <td class="border px-4 py-2">
                                    <channel-editing @edited="edited" :channel_id="channel.id">
                                        <jet-button type="button">
                                            Edit
                                        </jet-button>
                                    </channel-editing>
                                    <channel-deletion @deleted="deleted" :channel_id="channel.id">
                                        <jet-danger-button class="ml-1" type="button">
                                            Delete
                                        </jet-danger-button>
                                    </channel-deletion>
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
    import ChannelCreation from '@/Components/Channel/ChannelCreation'
    import ChannelEditing from '@/Components/Channel/ChannelEditing'
    import ChannelDeletion from '@/Components/Channel/ChannelDeletion'

    export default {
        props: {
            channels: Array,
        },

        components: {
            AppLayout,
            JetButton,
            JetDangerButton,
            ChannelCreation,
            ChannelEditing,
            ChannelDeletion,
        },

        methods: {
            created(created) {
                this.channels.push(created)
            },

            edited(edited) {
                let index = this.channels.findIndex((channel => channel.id == edited.id));
                this.channels[index].name = edited.name
                this.channels[index].radio_id = edited.radio_id
            },

            deleted(deleted) {
                let index = this.channels.findIndex((channel => channel.id == deleted.id));
                this.channels.splice(index, 1);
            }
        }
    }
</script>
