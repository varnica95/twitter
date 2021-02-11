<template>
    <form action="#" class="flex">
        <div class="mr-3">
            <img :src="this.user.avatar" class="rounded-full w-12">
        </div>

        <div class="flex-grow">
            <textarea
                class="bg-gray-900 w-full outline-none text-gray-300 text-lg resize-none mb-2"
                autofocus
                placeholder="What's happening?"
            ></textarea>

            <div class="flex justify-between">
                <div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="bg-blue-500 text-gray-300 text-center rounded-full leading-none px-4 py-3 font-bold"
                    >Tweet</button>
                </div>
            </div>
        </div>
    </form>
</template>
