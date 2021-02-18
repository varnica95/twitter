<template>
    <textarea
        class="bg-gray-900 w-full break-words outline-none text-gray-300 text-lg resize-none mb-2"
        autofocus
        placeholder="What's happening?"
        @input="input($event); resize($event)"
        :value="value"
    ></textarea>
</template>

<script>
    export default {
        data(){
            return  {
                body: ''
            }
        },
        props: {
            value: {
                required: false
            }
        },

        methods: {
            input(e) {
                this.$emit('input', e.target.value)
            },

            resize(e) {
                e.target.style.height = 'auto'

                if (e.target.value.trim() === ''){
                    e.target.style.overflow = 'hidden'
                    e.preventDefault()
                    return
                }

                e.target.style.whiteSpace = 'normal'
                e.target.style.wordBreak = ' break-word'

                e.target.style.height = `${e.target.scrollHeight}px`
            }
        }
    }
</script>
