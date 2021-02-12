export default {
    namespaced: true,

    state: {
        likes: []
    },

    getters: {
        likes(state){
            return state.likes
        }
    },

    mutations: {
        PUSH_LIKES(state, data){
            state.likes.push(...data)
        }
    },

    actions: {
        async likeTweet(_, tweet){
            await axios.post(`/api/timeline/tweets/${tweet.id}/likes`)
        },

        async unlikeTweet(_, tweet){
            await axios.delete(`/api/timeline/tweets/${tweet.id}/likes`)
        }
    }
}
