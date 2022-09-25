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
                <input v-model="form.email" placeholder="email">
                <!-- パスワード -->
                <input v-model="form.password" placeholder="password">
            </div>
            <button class="w-100" @click="login">Login</button>
        </div>
    </div>
</div>
</template>

<script lang="ts">
import { defineComponent, reactive, getCurrentInstance } from '@nuxtjs/composition-api'

interface State {
    email: string
    password: string
}

export default defineComponent({
    setup() {
        const root = getCurrentInstance()
        console.log(root)

        const form = reactive<State>({
            email: null,
            password: null
        })

        const login = async () => {
            try{
                // ログインする
                const response = await root.proxy.$auth
                    .loginWith('laravelApi', {
                        data: form
                    })
                    .then(() => {
                        // ログインに成功したら、/にページ遷移
                        console.log('ログインしました');
                        root.proxy.$router.push('/');
                    });
            } catch (error) {
                // ログインに失敗したら、コンソールに出力する
                console.log('ログイン失敗')
                console.log(error)
            }
        }

        return {
            form,
            login
        }
    },
})

/*
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
*/
</script>
