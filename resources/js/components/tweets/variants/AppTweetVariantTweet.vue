<template>
    <div class="flex w-full">
        <div class="mr-3">
            <img :src="tweet.user.avatar" class="rounded-full w-12">
        </div>
        <div class="flex-grow">
            <app-tweet-username
                :user="tweet.user"
            />
            <p class="text-gray-300 whitespace-pre-wrap">{{ tweet.body }}</p>

            <app-tweet-action-group
                :tweet="tweet"
            />
        </div>
    </div>
</template>

<script>
import AppTweetActionGroup from "../actions/AppTweetActionGroup";
export default {
    components: {AppTweetActionGroup},
    props: {
        tweet: {
            required: true,
            type: Object
        }
    }
}
</script>
