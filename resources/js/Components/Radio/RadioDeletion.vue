<template>
    <span>
        <span @click="startDeletionRadio">
            <slot />
        </span>

        <jet-dialog-modal :show="deletionRadio" @close="closeModal">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                
                <div class="col-span-6 sm:col-span-4 mt-2">
                    {{ content }}
                </div>

            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    Cancel
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click="deleteRadio">
                    {{ button }}
                </jet-danger-button>
            </template>
        </jet-dialog-modal>
    </span>
</template>

<script>
    import JetLabel from '@/Jetstream/Label'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        emits: ['deleted'],
        
        props: {
            radio_id: {
                type: Number,
                required: true,
            },
            title: {
                default: 'Delete Radio',
            },
            content: {
                default: 'Are you sure that you want to delete this radio?'
            },
            button: {
                default: 'Delete',
            }
        },

        components: {
            JetLabel,
            JetDangerButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
        },

        data() {
            return {
                deletionRadio: false,
                form: {
                    errors: ''
                },
            }
        },

        methods: {
            startDeletionRadio() {
                this.deletionRadio = true
            },

            closeModal() {
                this.deletionRadio = false
                this.form.error = ''
            },

            deleteRadio() {
                this.form.processing = true;

                axios.delete(route('radios.destroy', this.$props.radio_id), {
                }).then((deleted) => {
                    this.form.processing = false;
                    this.closeModal()
                    this.$nextTick(() => this.$emit(
                        'deleted',
                        {
                            id: deleted.data.id,
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