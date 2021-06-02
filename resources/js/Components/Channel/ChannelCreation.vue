<template>
    <span>
        <span @click="startCreatingChannel">
            <slot />
        </span>

        <jet-dialog-modal :show="creatingChannel" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Channel Name" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" placeholder="Channel Name"
                                ref="name"
                                v-model="form.name"
                                />
                    <jet-input-error v-if="form.errors.name != undefined"  :message="form.errors.name[0]" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <jet-label for="radio_id" value="Radio" />
                    <jet-input id="radio_id" type="text" class="mt-1 block w-full" placeholder="Radio"
                                ref="radio_id"
                                v-model="form.radio_id"
                                />
                    <jet-input-error v-if="form.errors.radio_id != undefined"  :message="form.errors.radio_id[0]" class="mt-2" />
                </div>

            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="createChannel">
                    {{ button }}
                </jet-button>
            </template>
        </jet-dialog-modal>
    </span>
</template>

<script>
    import JetLabel from '@/Jetstream/Label'
    import JetButton from '@/Jetstream/Button'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        emits: ['created'],
        
        props: {
            title: {
                default: 'Create New Channel',
            },
            button: {
                default: 'Create',
            }
        },

        components: {
            JetLabel,
            JetButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                creatingChannel: false,
                form: {
                    name: '',
                    errors: {
                        name: '',
                    },
                },
            }
        },

        methods: {
            startCreatingChannel() {
                this.creatingChannel = true
            },

            closeModal() {
                this.creatingChannel = false
                this.form.name = ''
                this.form.radio_id = ''
                this.form.error = ''
            },

            createChannel() {
                this.form.processing = true;

                axios.post(route('channels.store'), {
                    name: this.form.name,
                    radio_id: this.form.radio_id,
                }).then((created) => {
                    this.form.processing = false;
                    this.closeModal()
                    this.$nextTick(() => this.$emit(
                        'created',
                        {
                            id: created.data.id,
                            name: created.data.name,
                            radio_id: created.data.radio_id,
                        }
                    ))
                }).catch(error => {
                    this.form.processing = false;
                    this.form.errors = error.response.data.errors
                });
            },
        }
    }

</script>