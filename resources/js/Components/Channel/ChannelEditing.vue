<template>
    <span>
        <span @click="startEditingChannel">
            <slot />
        </span>

        <jet-dialog-modal :show="editingChannel" @close="closeModal">
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
                    <jet-input-error v-if="form.errors.name != undefined" :message="form.errors.name[0]" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <jet-label for="radio_id" value="Radio" />
                    <jet-input id="radio_id" type="number" class="mt-1 block w-full" placeholder="Radio"
                                min="0"
                                step="0.1"
                                ref="radio_id"
                                v-model="form.radio_id"
                                />
                    <jet-input-error v-if="form.errors.radio_id != undefined" :message="form.errors.radio_id[0]" class="mt-2" />
                </div>

            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="editChannel">
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
        emits: ['edited'],
        
        props: {
            channel_id: {
                type: Number,
                required: true,
            },
            title: {
                default: 'Edit Channel',
            },
            button: {
                default: 'Edit',
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
                editingChannel: false,
                form: {
                    name: '',
                    radio_id: '',
                    errors: {
                        name: '',
                        radio_id: '',
                    },
                },
            }
        },

        methods: {
            startEditingChannel() {
                this.editingChannel = true

                axios.get(route('channels.show', this.$props.channel_id), {
                }).then((radio) => {
                    this.form.processing = false;
                    this.form.name = radio.data.name
                    this.form.radio_id = radio.data.radio_id
                }).catch(error => {
                    this.form.processing = false;
                    this.form.errors = error.response.data.errors
                });
            },

            editChannel() {
                this.form.processing = true;

                axios.put(route('channels.update', this.$props.channel_id), {
                    name: this.form.name,
                    radio_id: this.form.radio_id,
                }).then((edited) => {
                    this.form.processing = false
                    this.closeModal()
                    this.$nextTick(() => this.$emit(
                        'edited',
                        {
                            id: edited.data.id,
                            name: edited.data.name,
                            radio_id: edited.data.radio_id,
                        }
                    ))
                }).catch(error => {
                    this.form.processing = false;
                    this.form.errors = error.response.data.errors
                    console.log(this.form.errors);
                });
            },

            closeModal() {
                this.editingChannel = false
                this.form.name = ''
                this.form.radio_id = ''
                this.form.errors = ''
            },
        }
    }

</script>