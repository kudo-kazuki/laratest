<template>
<div class="container">
    <h1>Logout</h1>
    <button @click="logout">Logout</button>
</div>
</template>

<script>
export default {
    data() {
        return {
            email: null,
            password: null
        };
    },
    methods: {
        // ログアウトする
        logout() {
            this.$auth.logout().then(() => {
                window.alert('ログアウトしました!');
                this.$router.push('/auth/login');
            });
        }
    },
};
</script>
