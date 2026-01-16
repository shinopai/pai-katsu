<template>
    <button
        class="post-card__like"
        :class="{ 'is-liked': liked }"
        @click="toggleLike"
        :disabled="loading"
    >
        <span class="post-card__like-count">{{ count }}</span>
    </button>
</template>

<!-- <script setup>
import { ref } from "vue";
import axios from "axios";

axios.defaults.headers.common = {
    "X-Requested-With": "XMLHttpRequest",
    "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
};

const props = defineProps({
    postId: {
        type: Number,
        required: true,
    },
    count: {
        type: Number,
        required: true,
    },
    liked: {
        type: Boolean,
        required: true,
    },
});

// propsは直接変更しない
const count = ref(props.count);
const liked = ref(props.liked);
const loading = ref(false);

const toggleLike = async (e) => {
    e.preventDefault();
    e.stopPropagation();

    if (loading.value) return;
    loading.value = true;

    // ===== optimistic update =====
    const prevLiked = liked.value;
    liked.value = !prevLiked;
    count.value += liked.value ? 1 : -1;

    try {
        await axios.post(`/api/posts/${props.postId}/like`);
    } catch (error) {
        // 失敗したら元に戻す
        liked.value = prevLiked;
        count.value += liked.value ? 1 : -1;
        console.error(error);
    } finally {
        loading.value = false;
    }
};
</script> -->

<script setup>
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
    postId: Number,
    count: [Number, String],
    liked: [Boolean, String],
});

const count = ref(Number(props.count));
const liked = ref(props.liked === true || props.liked === "true");
const loading = ref(false);

const toggleLike = async (e) => {
    e.preventDefault();
    e.stopPropagation();

    if (loading.value) return;
    loading.value = true;

    const prevLiked = liked.value;
    liked.value = !prevLiked;
    count.value += liked.value ? 1 : -1;

    try {
        await axios.post(`/api/posts/${props.postId}/like`);
    } catch {
        liked.value = prevLiked;
        count.value += liked.value ? 1 : -1;
    } finally {
        loading.value = false;
    }
};
</script>
