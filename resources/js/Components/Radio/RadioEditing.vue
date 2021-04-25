<template>
    <span>
        <span @click="startEditingRadio">
            <slot />
        </span>

        <jet-dialog-modal :show="editingRadio" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="radio_name" value="Radio Name" />
                    <jet-input id="radio_name" type="text" class="mt-1 block w-full" placeholder="Radio Name"
                                ref="radio_name"
                                v-model="form.radio_name"
                                />
                    <jet-input-error :message="form.errors.radio_name[0]" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <jet-label for="frequency" value="Frequency" />
                    <jet-input id="frequency" type="number" class="mt-1 block w-full" placeholder="Frequency"
                                min="0"
                                step="0.1"
                                ref="frequency"
                                v-model="form.frequency"
                                />
                    <jet-input-error :message="form.errors.frequency[0]" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4 mt-2">
                    <jet-label for="logo" value="Logo" />
                    <jet-input id="logo" type="file"
                                ref="logo"
                                v-model="form.logo"
                                />
                    <jet-input-error :message="form.errors.logo" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="editRadio">
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
            radio_id: {
                type: Number,
                required: true,
            },
            title: {
                default: 'Edit Radio',
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
                editingRadio: false,
                form: {
                    radio_name: '',
                    frequency: '',
                    errors: {
                        radio_name: '',
                        frequency: '',
                        logo: '',
                    },
                },
            }
        },

        methods: {
            startEditingRadio() {
                this.editingRadio = true

                axios.get(route('radios.show', this.$props.radio_id), {
                }).then((radio) => {
                    this.form.processing = false;
                    this.form.radio_name = radio.data.name
                    this.form.frequency = radio.data.frequency
                    this.form.logo = radio.data.logo
                }).catch(error => {
                    this.form.processing = false;
                    this.form.errors = error.response.data.errors
                });
            },

            editRadio() {
                this.form.processing = true;

                axios.put(route('radios.update', this.$props.radio_id), {
                    radio_name: this.form.radio_name,
                    frequency: this.form.frequency,
                    logo: this.form.logo,
                }).then((edited) => {
                    this.form.processing = false;
                    this.closeModal()
                    this.$nextTick(() => this.$emit(
                        'edited',
                        {
                            id: edited.data.id,
                            name: edited.data.name,
                            frequency: edited.data.frequency,
                            logo: edited.data.logo,
                        }
                    ))
                }).catch(error => {
                    this.form.processing = false;
                    this.form.errors = error.response.data.errors
                });
            },

            closeModal() {
                this.editingRadio = false
                this.form.radio_name = ''
                this.form.frequency = ''
                this.form.logo = ''
                this.form.error = ''
            },
        }
    }

</script>