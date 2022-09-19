<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Login</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <!-- メールアドレス -->
                <input v-model="email" placeholder="email">
                <!-- パスワード -->
                <input v-model="password" placeholder="password">
            </div>
            <button class="w-100" @click="login">Login</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    auth: false,
    data() {
        return {
            email: null,
            password: null
        }
    },
    methods: {
        async login() {
            try {
                // ログインする
                const response = await this.$auth
                    .loginWith('laravelApi', {
                        data: {
                            email: this.email,
                            password: this.password
                        }
                    })
                    .then(() => {
                        // ログインに成功したら、/にページ遷移
                        console.log('ログインしました');
                        this.$router.push('/');
                    });
                console.log(response);
            } catch (error) {
                // ログインに失敗したら、コンソールに出力する
                window.alert('ログイン失敗');
                console.log(error);
            }
        }
    }
}
</script>
