<template>
    <form action="#" class="flex" @submit.prevent="submit">
        <div class="mr-3">
            <img :src="this.user.avatar" class="rounded-full w-12">
        </div>

        <div class="flex-grow">
            <app-tweet-compose-textarea
                class="whitespace-nowrap"
                v-model="form.body"
            />

            <div class="flex justify-between">
                <ul class="flex items-center">
                    <li class="mr-4">
                        <app-tweet-compose-media-button
                            id="media-compose"
                            @selected="handleMediaSelected"
                        />
                    </li>
                </ul>

                <div class="flex items-center justify-end">
                    <div>
                        <app-tweet-compose-limit
                            :body="form.body"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-500 text-gray-300 text-center rounded-full leading-none px-4 py-3 font-bold"
                    >Tweet</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import AppTweetComposeTextarea from "./AppTweetComposeTextarea";
    import AppTweetComposeLimit from "./AppTweetComposeLimit";
    import AppTweetComposeMediaButton from "./media/AppTweetComposeMediaButton";
    export default {
        components: {AppTweetComposeMediaButton, AppTweetComposeLimit, AppTweetComposeTextarea},
        data() {
            return {
                form: {
                    body: '',
                    media: []
                },

                media: {
                    images: [],
                    video: null
                }
            }
        },

        methods: {
            async submit() {
                await axios.post('/api/timeline/tweets', this.form)

                this.form.body = ''
            },

            handleMediaSelected() {

            }
        }
    }
</script>
