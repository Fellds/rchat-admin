<template>
    <span>
        <span @click="startDeletionChannel">
            <slot />
        </span>

        <jet-dialog-modal :show="deletionChannel" @close="closeModal">
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

                <jet-danger-button class="ml-2" @click="deleteChannel">
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
            channel_id: {
                type: Number,
                required: true,
            },
            title: {
                default: 'Delete Channel',
            },
            content: {
                default: 'Are you sure that you want to delete this channel and all messages?'
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
                deletionChannel: false,
                form: {
                    errors: ''
                },
            }
        },

        methods: {
            startDeletionChannel() {
                this.deletionChannel = true
            },

            closeModal() {
                this.deletionChannel = false
                this.form.error = ''
            },

            deleteChannel() {
                this.form.processing = true;

                axios.delete(route('channels.destroy', this.$props.channel_id), {
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