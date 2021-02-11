<template>
    <div>
        <app-tweet
            v-for="tweet in tweets"
            :key="tweet.id"
            :tweet="tweet"
        />

        <div
            v-if="tweets.length"
            v-observe-visibility="{ callback: handleScrolledToBottom}"
        >

        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        data() {
            return {
                page: 1,
                lastPage: 1
            }
        },

        computed: {
            ...mapGetters({
                tweets: 'timeline/tweets'
            }),

            urlWithPage(){
                return `/api/timeline?page=${this.page}`
            }
        },

        methods: {
            ...mapActions({
                getTweets: 'timeline/getTweets'
            }),

            loadTweets(){
                this.getTweets(this.urlWithPage).then((response) => {
                    this.lastPage = response.data.meta.last_page
                })
            },

            handleScrolledToBottom(isVisible){
                if (! isVisible){
                    return
                }

                if (this.page === this.lastPage){
                    return
                }

                this.page++

                this.loadTweets()
            }
        },

        mounted() {
           this.loadTweets()
        }
    }
</script>
