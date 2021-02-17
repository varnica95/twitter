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
    }
}