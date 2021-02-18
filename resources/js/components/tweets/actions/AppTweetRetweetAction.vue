<template>
<div>
    <app-dropdown v-if="!retweeted">
        <template slot="trigger">
            <app-tweet-action-retweet-button
                :tweet="tweet"
            />
        </template>

        <app-dropdown-item @click.prevent="toggle">Retweet</app-dropdown-item>
        <app-dropdown-item>Retweet with a comment</app-dropdown-item>
    </app-dropdown>

    <app-tweet-action-retweet-button
        v-else
        :tweet="tweet"
        @click.prevent="toggle"
    />
</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
    props: ['tweet'],

    computed: {
        ...mapGetters({
            retweets: 'retweets/retweets'
        }),

        retweeted(){
            return this.retweets.includes(this.tweet.id)
        }
    },

    methods: {
        ...mapActions({
            tweetRetweet: 'retweets/tweetRetweet',
            tweetUnretweet: 'retweets/tweetUnretweet',
        }),

        toggle() {
            if (this.retweeted){
                this.tweetUnretweet(this.tweet)
                return
            }

            this.tweetRetweet(this.tweet)
        }
    }
}
</script>
