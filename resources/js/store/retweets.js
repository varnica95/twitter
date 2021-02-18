export default {
    namespaced: true,

    state: {
        retweets: []
    },

    getters: {
        retweets(state){
            return state.retweets
        }
    },

    mutations: {
        PUSH_RETWEETS(state, data){
            state.retweets.push(...data)
        }
    },

    actions: {
        async tweetRetweet(_, tweet){
            await axios.post(`/api/timeline/tweets/${tweet.id}/retweets`)
        },

        async tweetUnretweet(_, tweet){
            await axios.delete(`/api/timeline/tweets/${tweet.id}/retweets`)
        },
    }
}
